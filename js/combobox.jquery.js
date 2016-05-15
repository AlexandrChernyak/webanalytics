// jQuery UI Autocomplete - Combobox (mod)
// Required files: ui/jquery.ui.core.js, ui/jquery.ui.widget.js, ui/jquery.ui.position.js, jquery.ui.autocomplete.js

;(function()
{
	$.fn.combobox = function( config )
	{
		// параметры плагина по умолчанию
		config = $.extend(
		{
			buttonText	: '&#9660;', 
			buttonShow	: true,
			change		: null	// callback function
		}, config);

		return this.each(function()
		{
			var 
				box 		= $(this).hide(),
				options		= box.children('option'),
				form 		= box.parents('form:first'),
				multiple 	= box.attr('multiple'),
				disabled 	= box.attr('disabled'),
				
				splitter = {
					regexp: /\s*,\s*/,
					text: ', '
				},
				specials = {
					opt_select_all: options.filter('[value="combobox-select-all"]')[0] || new Option
				},
				
				sel_all_is_native 		= specials.opt_select_all.getAttribute('value') != null,
				value 					= $.makeArray( options.filter(':selected').map(function(){ return this.innerHTML }) ).join(splitter.text),
				options_text_joined 	= $.makeArray( options.not(specials.opt_select_all).map(function(){ return this.innerHTML }) ).join( splitter.text ),
				
				combobox =  	
							$('<div class="ui-combobox"><input class="ui-widget ui-widget-content ui-corner-left"/><button type="button" style="display:'+ 
							(config.buttonShow ? 'inline': 'none') +';">'+ config.buttonText 
							  +'</button></div>')
								.insertAfter(box),
								
				input = combobox
						.find('input')
						.data('form.element', box)
						.attr(
						{
							title: value,
							disabled: disabled
						})
						.val(value),
						
				button = combobox.find('button')
						.attr(
						{
							title: 'Show all items',
							tabIndex: -1,
							disabled: disabled
						});
			
			// сохраняем некоторые дополнительные статические события в jQuery.data
			config.change && box.data('ui.events', 
			{
				change: config.change
			});
			
			// удаляем комбобокс, если он уже был ранее создан и сохраняем ссылку на элементе формы
			if( box.data('combobox') )
			{
				// фикс при перерисовке комбобокса, если до этого был выбран пункт меню "Выделить всё"
				if( box.data('combobox').find('input').val() == specials.opt_select_all.innerHTML )
				{
					specials.opt_select_all.selected = true;
					specials.opt_select_all.className = 'selected';
				}
				box.data('combobox').remove();
			}
			box.data('combobox', combobox);
			
			// 
			function highlightingMatchedSymb( text, symbols )
			{
				return text.replace( new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + symbols + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>" )
			}

			// вызываем виджет на основе которого создается комбобокс
			input.autocomplete
			({
				delay: 0,
				minLength: 0,
				
				// событие формирует список каждый раз при наборе символов в поле
				source: function( request, response )
				{
					var 
						text 		= multiple ? request.term.split(splitter.text).pop() : request.term,
						matcher 	= new RegExp($.ui.autocomplete.escapeRegex(text), "i" ),
						data 		= options.map(function()
						{
							var 
								value = this.value,
								title = this.innerHTML,
								matchedBy = 
								{
									value: matcher.test(value),
									title: matcher.test(title)
								};
							
							if( value && (matchedBy.value || matchedBy.title) )
							{
								var 
									html = matchedBy.title ? highlightingMatchedSymb(title, text) : title,
									label = !matchedBy.title && matchedBy.value ? html + ' ('+ highlightingMatchedSymb(value, text) +')' : html;
								
								return {
									label: label,
									value: title,
									option: this
								}
							}
						});
					
					input.removeData('shiftKeySelect');
					response(data);
				},
				
				// событие срабатывает при выборе пункта из выпадающего списка
				select: function( event, ui )
				{
					var 
						current = ui.item && ui.item.option,
						value 	= ui.item && ui.item.value,
						list 	= multiple ? this.value.split(splitter.regexp) : [value || this.value], 
						index 	= $.inArray(value, list),
						range 	= input.data('shiftKeySelect') || [], // selections with shift-key
						sel_all = specials.opt_select_all,
						last_val = sel_all.className == 'selected' ? sel_all.innerHTML : this.value ;

					// сохраняем значение комбобокса до того момента, пока не сработает onchange (важно для исправления глюков в сраном ие)
					if( ! input.data('lastSavedValue') ) input.data('lastSavedValue', last_val);

					// fix for auto-submit form
					//form.one('submit', function(){ return false });

					// выделяем все элементы селекта, если выбран специальный опшн
					if( autocomplete.selectAll(ui.item) && sel_all_is_native ) return false;
					
					if( current != sel_all )
					{
						// фикс при выделении элемента, если до этого были выбраны/выделены все
						if( sel_all_is_native && sel_all.className == 'selected' )
						{
							var menu_li = autocomplete.menu.element.find('li');
							
							sel_all.className = '';
							menu_li.filter('.'+ sel_all.value).removeClass('selected ui-state-focus');
							
							if( event.shiftKey )
							{
								menu_li.removeClass('ui-state-focus');
								input.data('shiftKeySelect', [current]);
							}
							
							else if( event.ctrlKey )
							{
								current.selected = ! current.selected;
								list = $.makeArray(options.filter(':selected').map(function(){ return this.innerHTML }));
							}
							
							else index == -1 ? list.push(value) : list.splice(index, 1);
						}
						
						// otherwise
						else if( multiple && ui.item )
						{
							index == -1 ? list.push(value) : list.splice(index, 1);
							
							if( event.shiftKey ) input.data('shiftKeySelect', range.concat(current));
							else if( event.ctrlKey )
							{
								// выделяем элемент "select-all" если выбраны все пункты кроме него вручную
								if( options.has(sel_all) && list.length == options.not(sel_all).length )
								{
									input.trigger('keydown.combobox', [true]);
									return false;
								}
							}
						}
					}
					
					var values = $.makeArray
					(
					 	options
							.attr('selected', false)
							.map(function()
							{
								var value = this.innerHTML;
								
								if( $.inArray(value, list) !== -1 && this !== sel_all  )
								{
									this.selected = true;
									return value;
								}
							})
					 );
					
					value = values.join(splitter.text);
					input
						.attr('title', value)
						.val( value );
					
					return false;
				},
				
				// событие срабатывает только при изменении содержимого комбобокса при потере фокуса с него
				change: function( event, ui )
				{
					autocomplete._trigger('select', event, {}); // must be in top
					
					var 
						sel_all_val 	= specials.opt_select_all.innerHTML,
						last_val 		= input.data('lastSavedValue'),
						box_val 		= $.makeArray(options.filter(':selected').map(function(){ return this.innerHTML })).join( splitter.text ),
						input_val 		= this.value;
					
					if( ((last_val && last_val != input_val))
						  ||
						  (last_val === '' && input_val === '' )
						  || 
						( box_val != input_val && input_val != sel_all_val))
					{
						box.data('ui.events') && box.data('ui.events').change.apply(this, arguments);
						input.removeData('lastSavedValue');
					}
				},
				
				// отменяем событие чтобы не перезаписывать поле ввода при множественном выборе значений
				focus: function( event, ui )
				{
					return false;
				}
			});
			
			var autocomplete = input.data('autocomplete');
			
			$.extend( autocomplete,
			{
				_renderItem: function( ul, item )
				{
					var 
						selected,
						option = item.option,
						selected_all = specials.opt_select_all;
					
					if( selected_all.value == option.value && option.innerHTML == input.val() )
						option.className = 'selected';
					
					selected = option.selected || (option.className == 'selected');
					
					return $( "<li></li>" )
							[ selected ? 'addClass' : 'removeClass' ]('ui-corner-all ui-state-focus')
							.data( "item.autocomplete", item )
							.append( "<a>" + item.label + "</a>" )
							.addClass( selected_all == option ? selected_all.value : '' ) // добавляем специальные класс для элемента "select all"
							.appendTo( ul );
				},
				
				close: function( event )
				{
					clearTimeout( this.closing );
					
					this.term = this.element.val();
					this.menu.active && this.menu.active.toggleClass('ui-corner-all ui-state-focus');
					
					if( event )
					{
						if( event.target.getAttribute('role') != 'listbox' && input.data('lastSavedValue') !== null )
						{
							this._trigger('change', event, {}); // IE bug fix
						}
						
						if( (! event.ctrlKey && ! event.shiftKey) || !multiple )
						{
							this.menu.element.hide();
							this.menu.deactivate();
						}
						
						// вызываем обработчик при выборке области комбобокса (shift+click)
						if( event.shiftKey && input.data('shiftKeySelect').length == 2 ) this.selectRange();
					}
				},
				
				// selecting range with shift-key
				selectRange: function()
				{
					var 
						range 	= input.data('shiftKeySelect').sort(function(a,b){ return a.index - b.index }),
						from 	= range[0],
						to 		= range[1];
					
					if( from != to )
					{
						// выделяем выбранный диапазон в самом селекте и выпадающем списке меню комбобокса
						for( var i = from.index; i <= to.index; i++ )
						{
							 options[i].selected = true;
							 
							 this.menu.element
							 	.find('li[role="menuitem"]:eq('+ i +')')
								.addClass('ui-corner-all ui-state-focus');
						}
						
						var value = $.makeArray(
									options.filter(':selected').map(function(){ return this.innerHTML })
								).join( splitter.text )
							
						this.element.val(value);
						this.term = value;
					}
					
					input.removeData('shiftKeySelect');
				},
				
				// selecting all options, if selected special-option
				selectAll: function( item )
				{
					var
						sel_all 			= specials.opt_select_all,
						sel_all_val 		= specials.opt_select_all.innerHTML,
						value 				= input.val(),
						selecting 			= true;
					
					if(( item && item.option === sel_all) // fired on autocomlete select
					   || 
					  ( !item && value == sel_all_val )) // fired on autocomlete change
					{
						if( item && !sel_all.selected ) // второе условие (с selected) нужно чтобы не срабатывал toggleClass при повторной перерисовке комбобокса
						{
							var selected = $(sel_all).toggleClass('selected').hasClass('selected');
							if( ! selected || options.filter(':selected').length == options.length )
							{
								selecting = false;
								sel_all_val = '';
							}
						}
						
						// select-all fix for ctrl+a
						if( selecting && !sel_all_is_native )
							sel_all_val = options_text_joined;
						
						options
							.attr('selected', false)
							.not( sel_all )
							.attr('selected', selecting);
						
						input
							.val( sel_all_val )
							.removeAttr('title');
						
						return true;
					}
				}
			});
			
			button.click(function( evt, whatsearch )
			{
				input.autocomplete( "search", whatsearch || '' );
				input
					.select()
					.focus();			
			});
			
			// fix for the parent's label
			box.parents('label:first').bind('click.combobox', function()
			{
				input.focus();
			});
			
			// обновляем список элементов, если выбран пункт "select-all" изначально при загрузке страницы
			if( specials.opt_select_all.selected )
			{
				autocomplete._trigger('select', event, {item: { option: specials.opt_select_all }});
			}

			// select\deselect all options by ctrl+a
			input.bind('keydown.combobox', function(event, custom_triggering)
			{
				if( (event.ctrlKey && 
				    event.keyCode == 'A'.charCodeAt(0) &&
					autocomplete.menu.element.is(':visible'))
				   ||
				   custom_triggering
				){
					autocomplete._trigger('select', event, {});
					autocomplete.selectAll({ option: specials.opt_select_all });
					button.click();
				}
			});

		});
	}
	
})(jQuery);
