<?php
 /** Модуль строк английского языка
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_language_obj {
  private $control = null;	
  protected
   $data = array(
     /* v1.4.4 */
     'id_pagespeed_online:paramname' => 'Page Speed',
     'id_linkstodomain_p:paramname' => 'Links to domain',
     'id_donorscount_p:paramname' => 'Donors',
     'id_outlinkscount_p:paramname' => 'Out links',
     
     'toolopt_pagespeedapi' => "Api code Google PageSpeed Online (if empty - block don`t used!)",
     'toolopt_pagespeedapi-userip' => "Use in block Google PageSpeed Online restrictions over IP (userIp parameter is passed for further restrictions on the parameters of your account by Google)",
     
     
    
     /* v1.4.3 */
     'toolbase64encodedecode' => 'Base64 encoding text', 
       
     /* v1.4.1 */
     'toolupdatesinformer' => "Informers of updates search engines",
   
     /* v1.4.0 */
    'W_HTMLCODELEFTDOWNBLOCKAFTMENU_dsc' => "HTML code displayed in the left side of the site following the (lower) `block main menu`",    
    'admtoolsimagesdescrtext' => 'Tools Icons',
    'toolconfigureopticons'  => "Icons `[%s]`",
    'toolnamedcssspritesgen' => 'CSS Sprites - union of images',
    'toolopt_maximagescount' => "<label id='red'>*</label> Maximum number of images to load (the association)",
    'admadmusersgroupstext' => 'Users Groups',
    'admfilescontroltext' => 'Files control',
    'nospecifiedidentfiles' => 'Not defined for the group ID of files!',
    'nospecifiedidentfilesid' => 'Not defined for the object identifier specified investments or incorrect ID!',
    'recordstitlenamed' => 'Records',
    'recordstitlenamedpers' => 'Personal Pages',
    'payfilesdescriptionhistory' => 'Payment Download file [@s]',
    'administatorsgroupZ' => 'Administrators', //название группы админов - все пользователи в группе с этим названием будут иметь права администратора проекта
    'administatorsgroupZdescr' => 'Administrators',
    'downloadingfiledata' => 'Download file [[%s]]',
    'errorindownloadfile' => 'An error occurred when accessing the file! Maybe you do not have permission to download this file!',
    'subjdownloadfiledata' => 'Copy of file [[%s]] from site [[%s]]',
    'bodydownloadfiledata' => "You have downloaded file [[%s]], provided for a fee!\r\nCopy of file was sent to your e-mail, listed in your account.\r\n\r\nCopy of file attached to letter!\r\n",
    'admbunnerscontroltext' => 'Displaying banners on site',
    'setalinktobannerfile' => 'Enter a link to banner file (the link to an image or flash animation)',
    'setalinktohrefdataf' => 'Enter a link to which to move by clicking on the banner!',
    'bannocorrectcountlook' => 'Enter the desired number of banner impressions (not less than 100, the value must be numeric)',
    'pricebannerlookcount' => 'Banner in [[%s]] for [%s] views',
    'bannocorrectcountday' => 'Enter the desired number of days banner impressions (not less than 1, the value must be numeric)',
    'pricebannerdayscount' => 'Banner in [[%s]] for [%s] days',
    'banneraddtomoderst' => 'Added a banner, pending verification before payment!',
    'banneraddtomoderstdata' => "User [[%s]] requested placement of a banner at [[%s]]!\r\n\r\nCheck and confirm the authorization to pay for a banner you can in the administrative section, at\r\n[%s]\r\n\r\n",
    'banneractivatemessage' => "You been activated display banner at [[%s]]\r\n\r\nThe total period of display banner (hits/days): [%s]/[%s]\r\n\r\n",
    'activatebannertitle' => 'Added banner at `[%s]` on site `[%s]`',
    'activatebanneraddwadmin' => "User [[%s]] added new banner at [[%s]]!\r\nBanner is active!\r\nControl banners at: [%s]\r\n",
    'activateuserbannerst' => 'Confirmation check banner with administrator on [%s]',
    'activateuserbannerstdata' => "Hello, [%s]!\r\n\r\nWe inform you that you have added the banner successfully pass the test administrator!\r\nYou can pay for placement of your banner on the site [%s] in your personal account at [%s]\r\n",
    'advertisingoursitebyselect' => 'Your advertisement on our site',
    'inactiveparamslook' => 'On one of your banners on [%s] ended impressions',
    'inactivebannersetdata' => "Hello, [%s]!\r\n\r\nWe inform you that one of your banners posted on site [%s] ([%s]) resulted in displays!\r\nBanner moved to mode `Payment waiting`.\r\n\r\nYou can prolong your banner paid for the desired time display in `My Banners` at\r\n[%s]\r\n",
    'id_alexarank_value:paramname' => 'Alexa Rank',
    
   
    /* v1.3.8 */
    'admspecpageslistnamemenu' => 'Individual pages in project',
    'pageidentifierisexists' => 'This page ID already exists! Set the other way!',
   
    /* v1.3.5 */
    'admsectiongroupingtools' => 'Grouping tools',
    'groupisalridyexists' => 'The group with ID [[%s]] already exists!',
    'groupdefaultidentifytxt' => 'Ather Tools',
    
    'xml-api-description-1' => 'Search Engine updates',
    'xml-api-description-2' => 'Showcase link api',
    'admrefbunnerssection' => 'Referral banners',
    
    
    /* v1.3.1 */
	'setcorrectnameofpathnews' => "Path partition must consist of characters [a-z,а-я,A-Z,А-Я,-,_] and must not be empty!",
	'selsectionnameof' => "Enter name of block section!",
	'allsectionslistentblck' => "All sections [news/articles]",
	'toolopt_metadesc' => "The row identifier meta tag description (empty - tag is not used)",
	'W_DEFAULTDOMAINDESCRIPTION_dsc' => "Meta description by default (empty - tag is not used).",
	'hiddensourcetext' => 'Hide text',
	'viewinnewwindowopened' => "Open Image (opened in new window)",
	
    /* v1.3.0 */
    'toolstyposinkeyboard' => "Generator typos touch typing",    
    
    /* v1.2.9 */
    'toolmassvischeck' => "Mass attendance verification on LI",
    
    /* v1.2.7 */
    'accessdinedbyadmin' => "Access to this section is temporarily closed by the administrator! We apologize for any inconvenience caused. Try to access this section in 5 minutes.",
    
    'p_paramisdisabledn'=> "Parameter is Disabled!",
    'paramisexistsalridyp' => "Parameter [[%s]] already exists!",
    'seopanelstitledid' => "SEO Panel",
    'p_selectnewsection'=> "Enter the name of new section!",
    'p_sectisexistsalr' => "Section [%s] already exists! Please choose another section title!",
    'p_identsectnotfou' => 'Unknow Section ID',
    'p_youlockedinpanel'=> "You don't have access to SEO panel! Reason: [%s]",
    
	'defurltdname:paramname'          => 'URL',
    'p_id_cy_value:paramname'         => 'CY',
    'p_id_pr_value:paramname'         => 'PR',
    'id_yaca_dir_value:paramname'     => 'YACA',
    'id_dmoz_dir_value:paramname'     => 'DMOZ',   
    'id_yandexindex_value:paramname'  => 'Index Yandex',
    'id_googleindex_value:paramname'  => 'Index Google',
    'id_liveinternet_value:paramname' => 'LiveInternet',
    'id_dateupdate_value:paramname'   => 'Updated',
    'id_domain_expire:paramname'      => 'Extended until',
    'id_dateformat:paramname'         => '',
    'controlpanel:paramname'          => 'Action',  
    'id_yandexback_value:paramname'   => 'Yandex Back',
    'id_googleback_value:paramname'   => 'Google Back',
    'id_yahooindex_value:paramname'   => 'Index Yahoo',
    'id_yahooback_value:paramname'    => 'Yahoo Back',
    'id_bingindex_value:paramname'    => 'Index Bing',
    'id_bingback_value:paramname'     => 'Bing Back',
    
    'p_urlisexiststhis' => 'Site [[%s]] already exists!',
    'yesstringidentsimply' => 'Yes',
    'nostringidentsimply' => 'No',
    
    
    /* v1.1.0 */
    'simplethemeidw'    => "By Default",
    /* v1.0.0 */
    'getdefaultlangit'  => "Alternative (empty)",
    'setlogindata'      => "Enter your username!",
    'setpassdata'       => "Enter your password!",
    'unknowloginorpass' => "Invalid username or password!",
	'activregisteracc'  => "Confirmation of registration account [%s]",
	'accountisblock'    => "Account [%s] is locked!\r\nReason:\r\n[%s]",
	'register'          => "Register",
	'registerl'         => "New User Registration",
	'restorepsw'        => "Password recovery",
	'activateact'       => "Activate Account",
	'cantregisteruser'  => "Registration temporarily disabled! We apologize for any inconvenience.",
	'selectlogin'       => "Choose a username!",
	'incorrectlogin'    => "Login may consist of [0-9A-Za-z_], and must not consist solely of digits!",
	'selectmail'        => "Select the e-mail!",
	'loginalredy'       => "This username or e-mail is already in use!",
	'emailalridyisset'  => "This E-mail is already in use by another user!",
	'numbisnotvalid'    => "Text from the image specified is not valid!",
	'registernewsuc'    => "Confirmation of registration site [%s]",
    'registernewsuc2'   => "Register online at [%s]",
	'registernewsuc3'   => "User registration [%s] at site [%s]",		    
    'codeincorrectu'    => "The activation code is damaged or is unreachable!",
    'paramsincorrect'   => "False to pass parameters! One of the identifiers are not recognized!",
    'passissendto'      => "The new password is successfully activated! You can use it to enter the cabinet!",
    'logormailincorr'   => "Invalid username or e-mail!",
    'boutrestpasswff'   => "Activating a new password for this site [%s] for [%s]",
    'infoofrestissendt' => "Instructions for resetting your password sent to you e-mail, specified at registration!",
    'genhostdomain'     => "Home",
    'accountuserdef'    => "User [%s]",
    'accountuserdef2'   => "User Account [%s]",
    'settings'          => "Settings",
    'avatardeleted'     => "Avatar removed!",
	'cantparseimginfo'  => "Unable to get information about the image!",
	'typenotsupport'    => "File type does not match its expansion is!",
	'imgwidthnomatch'   => "Width of the image exceeds the permitted in the selected format [[%s]px]!",
	'imgheightnomatch'  => "Image height exceeds the allowable for the chosen format in [[%s]px]!",
	'fileformatnotmatch'=> "Invalid file format!",
	'filetypenoident'   => "Invalid File Format [[%s]]! Possible file types: [<b>[%s]</b>]",
	'fileisempty'       => "You are trying to upload empty file!",
	'errorindwloadfile' => "There was an error downloading the file! Could not load file...",
	'errorsetnewavatar' => "Error installing avatar!",
	'avatarisset'       => "Avatar has been successfully installed!",
	'errorgetuserinfo'  => "Failed to get user information!",
	'passisincorrect'   => "The password is incorrect!",
	'plssetpasswnew'    => "You must specify a non-empty password!",
	'optnochangeredy'   => "Settings do not differ from established. Parameters are not changed.",
	'optionsissavedok'  => "Saved successfully!",
	'optionsisnochok'   => "Settings are not changed!",
	'mailaccount'       => "Mail",
	'privatemessages'   => "Private Messages",
	'newmaildoit'       => "New Message",
	'newprivatemessage' => "New Private Message",
	'noinfoforsendmess' => "Bad data to send a message!",
	'nosubjectmess'     => "No Subject",
	'nomessagefoundonu' => "Message ID [[%s]] not found!",
	'nouserfoundbe'     => "User [[%s]] not found!",
	'newmessagesubg'    => "New message on [%s] from [%s]",
	'nomessagessended'  => "Message not sent! An error occurred while sending a message..",
	'messagebesended'   => "Message sent successfully!",	   
    'threadmeilmess'    => "Correspondence",
    'threadsoutput'     => "Outgoing",
    'threadsinput'      => "Incoming",
    'balancehistory'    => "Financial Operations",
    'balancehistoryadd' => "Updating balance",
    'paybalanceuser'    => "Updating account balance [%s]",
    'errorpaycheckpar'  => "Error of parameter identification!",
    'addmoneytouser'    => 'Updating account balance [%s] to the amount of [%s] $',
    'submoneytouser'    => 'Withdrawal from the account balance [%s] amount of [%s] $',
    'setmoneytouser'    => 'Setting your account balance [%s] to the amount of [%s] $',
    'nomoneyforaction'  => "Insufficient funds on the balance sheet!",
    'payisdoneok'       => "Payment has been completed successfully!",
    'payisdonenook'     => "An error occurred payment, or you refuse to pay!",
    'statuspaydoneprc'  => "Payment status",
    'paymoneyfromrbx'   => "Balance replenishment through [%s]",
    'unknowpaymetchod'  => "Unknown method to replenish the balance",
    'getmoneyfromrefer' => "Receiving funds from referral [%s]",  
	'useringopage'      => "User Info [%s]",
    'usernotfoundond'   => "User not found or the user account is not activated!",
    'activeindexsiteon' => "Activation of indexing your site on your account page",
    'dayslastperiod'    => "[%s] days ago",   
	'istodaynowstr'     => "today",
    'isyestodaynowstr'  => "yesterday",
    'isafteryestodaystr'=> "day before yesterday",
    'paytoinvitecode'   => "Invite activation code",
    'adminsectionaccout'=> "Administrative Section",
	'adminvitesections' => "Invite registration codes",
	'admaddnewinvite'   => "Creating an invite code",
	'adnnoadminuseris'  => "To perform the operation must have Administrator rights!",
	'admengineupdatest' => "Updates search engine",
	'addnewengineupdate'=> "Adding a search engine updates",
	'admgooglecentersl' => "Google Datacentres",
	'admgooglecentadd'  => "Adding a Google data center",
	'addeddatacenters'  => "Added datacenters - [%s]",
	'admfontssectionn'  => "Font files",
	'noidentfontdata'   => "Unknown font id!",
	'adminformersfilesp'=> "Images Informer",
	'admnewssectinterne'=> "Internet News",
	'admnewssectsite'   => "Site News",
	'newsisnotfoundnow' => "Not found!",
	'setcommentsource'  => "Enter the text of your comment!",
	'addnewcomment3'    => "You added a comment on this site [%s] to [%s]",
	
	'unknowinformdata'  => "These have not been identified!",
	'pleasuresettitle'  => "Enter the name of news",
	'pleasuresetsource' => "Enter the text of the news",
	'newsalridyexistsw' => "News [[%s]] already exists! Specify another name for news!",
	'newslistensection' => "News",
	
	'dateupdateisexists'=> "Date [%s] already exists!",	
	'getupdatesdesc1'   => "Yandex CY",
	'getupdatesdesc2'   => "Yandex search",
	'getupdatesdesc3'   => "Yandex directory",
	'getupdatesdesc4'   => "Google PR",
	'toolstextsourced'  => "Tools",
	'linksvitrinasect'  => "Showcase Links",
	'linksaddnewlink'   => "Add a link",
	'nocorrecturlforset'=> "Invalid URL (URL address error analysis links)",
	'younotonlineuser'  => "You are not logged in! Please login..",
	'moneytolinkvitrina'=> "Adding a link to links vitrina.",
	'summlinkpaynocorre'=> "The sum of adding a reference to showcase links - incorrect!",
	
	'toolgetserversite' => "Getting the site server",
	'toolgetipsite'     => "Getting the ip site",
	'toolmasscheckdom'  => "Bulk check of domains on employment",
	'toolmassurlspeedt' => "Mass test speed site",
	'toolmassredirectge'=> "Check the site redirects",
	'toolheadersview'   => "View the site title",
	'toolpingtracerout' => "Accessibility Site Ping\Tracerout",
    'toolpunycodeconv'  => "Convert Cyril. domain (Punycode)",
    'toolgetwhoisipurl' => "WHOIS IP site",
    'toolgetwhoisdomain'=> "WHOIS domain owner's site",
    'toolmassprcychecke'=> "Mass check PR\CY",
    'toolgooglebydcchec'=> "Check Google PageRank for datacenters",
    'toolgetlinkprice'  => "Valuation of links from the site",
    'toolcheckurllinks' => "Analysis of external and internal links",
    'toolviewurlasrobot'=> "Site through the eyes of a search robot",
    'toolcontentanalise'=> "Analysis of the site's content",
    'toolurlsiteanalise'=> "Site Analysis",
	'toolkeygeneratorurl' => "Keyword generator from site",
	'toolkeygeneratortxt' => "Generator keywords from text",
	'toolbrowserinfo'   => "Information about your IP, browser",
	'toolinternetspeed' => "Speed Internet connection",
	'tooltextanalisis'  => "Text analysis (length, stop-words...)",
	'toolencodespecchar'=> "Screening\De specials. Character",
	'toolencodedecodeu' => "Encode\Decpde URL",
	'toolstrencrapt'    => "Encryption strings",
	'toolpassgenerator' => "Password Generator",
	'tooljavascriptpack'=> "Packing JavaScript code",
	'toolcsspack'       => "Packaging CSS code",
	'toolhtmlcrapt'     => "Encrypting HTML into JavaScript code",
	'tooltextcompere'   => "Percentage comparison of the text",
	'toolnorepeatlines' => "Delete duplicate rows",
	'toolstringtranslit'=> "Translit Translator",
	'toolstaturlgenerat'=> "Static URL generator",
	'toolrobotsgenerat' => "Robots.txt generator",
	'tooltitlegenerator'=> "Title generator (title)",
	'toollinkgenerator' => "Generator of unique links",
	'toolextractemails' => "Retrieving E-Mail Address",
	'toolextractlinks'  => "Removing site links",
	'toolchecklinktobac'=> "Check back links",
	'toolmetagenerator' => "META Tag Generator",
	'toolfavoritgenerat'=> "Icons FavIcon Generator",
	'tooltexttoimage'   => "Drawing text on image",
	'toolipinformer'    => "Informer IP address",
	'toolprcyinformer'  => "Informer PR and CY",
	
	
	'toolnolimitdescri' => "Removing the limit test [[%s]]",
	'erroractiontool'   => "Error executing action [[%s]]",
	
	
	'nocorrectpage'     => "Error integrity of the page",
	'nourlsforanalize'  => "No data for analysis",
	'gotonextitemlist'  => "Waiting for the next site...<br />(<b>[%s]</b> of <b>[%s]</b>)",
	'ispausedactionbe'  => "The maximum number of sites inspected! [[%s]]",
	'ispausedonactionl' => "Check adjourned on (page <b>Arrayindexed</b> of <b>Arraylenght</b>)...<br />&nbsp;",
	'preperetostartajax'=> "Preparing to stop inspections...<br />(<b>[%s]</b> of <b>[%s]</b>)",
	'preptopausedajms'  => "Preparing for the suspension of inspections at position <b>Arrayindexed</b> of <b>Arraylenght</b>...<br />(<b>[%s]</b> of <b>[%s]</b>)",
	'actionisstoppedb'  => "Checking stopped...",
	'actionisfinishedb' => "Checking completed...",
	'isprocessactionit' => "Analysis : <b>Linkfcheck</b>..<br />(<b>Arrayindexed</b> of <b>Arraylenght</b>)",
	'actiontopayststusq'=> "Processing request, please wait..", 
	
	'listinyadirget'    => "The presence in catalogs",
	'nonameforsection'  => "Enter the name of the section!",
	'sectisexistsnow'   => "Section [[%s]] already exists! Specify a different name section..",  
    'addnewcommentinf'  => "Added a new comment on the site [%s] to [%s]",
    'admcommentslabel'  => "Comments",
    'admtoolsoptions'   => "Tools Settings",
    'toolconfigureopt'  => "Setting [%s]",
    'admstringstablesec'=> "Strings Table",
    'setidentnametoset' => "Enter the string ID!",
    'identisalrexists'  => "ID [[%s]] already exists! Specify a different version identifier..",
    'issystemidentuse'  => "ID [[%s]] used systematically and can not be specified for custom strings! Specify a different version identifier..",
    'defaultvaluedtr'   => "System",
    'emptyvaluestrp'    => "empty",
    'feedbacksectgetis' => "Feedback",
    'selectanameusers'  => "Enter Your Name!",
    'selectatitlemess'  => "Enter the subject of the message!",
    'selectadatamess'   => "Enter your message!",
    'messagefeedtitle'  => "Message from [[%s]] from site [%s] [[%s]]",
    'admgeneralsubopt'  => "Add-Ins site",
    'admredirectlktable'=> "Redirect links",
    'setlinkhreftoredir'=> "Enter the URL for redirection..",
    'linkhrefisexistsnw'=> "This URL already exists! His ID: <b>[%s]</b>",
    
    'errorgetdocument400' => "400 Bad Request.",
    'errorgetdocument401' => "401 Unauthorized.",
    'errorgetdocument403' => "403 Forbidden.",
    'errorgetdocument404' => "404 Not Found.",
    
    'admuserslistenstrtbl'=> "Community Site",
    'modifylabeliditemstr'=> "Modify",
    'admsectiongeneralinf'=> "General Information",
    
    
    //--------------------------- названия параметров инструментов begin -----------
    'toolopt_descr' => "<label id='red'>*</label> The ID of the `short` description of the tool (name)",
    'toolopt_Ldescr' => "The ID of `average` description of the tool (optional), appears in the list of tools.",
    'toolopt_onlineonly' => 'Provide access to the tool only if the visitor is logged on the site.',
    'toolopt_enabled' => "Include payment withdrawal limit using the tool.",
    'toolopt_price' => "<label id='red'>*</label> Price (USD) withdrawal limit of the instrument. (format: 0.00)",
    'toolopt_sleep' => "<label id='red'>*</label> Delay before you scan (seconds)",
    'toolopt_timeout' => "<label id='red'>*</label> The maximum waiting time for a query. (seconds)",
    'toolopt_count' => "<label id='red'>*</label> Maximum number of inspections in a restricted mode.",
    'toolopt_maxsteps' => "<label id='red'>*</label> Maximum number of jumps.",
    'toolopt_stepsel' => "<label id='red'>*</label> Maximum number of jumps (default).",
    'toolopt_direct' => "Destination inspection: DESC - descending dates, '' - ascending Date added datacenter.",
    'toolopt_docachonget' => "Cache and retrieve data from the cache when you open a permanent page analysis. (example: / tool / contentcheck / forwebm.net - data is cached in 5 days)",
    'toolopt_docachonpost' => "Use force to update the cache when a post test site, the data in the cache will be continuously updated with analysis from the page tool. If disabled - will be updated on a regular page of cache expiration.",
    'toolopt_usehistory' => "Keep a record of the above analysis tool.",
    'toolopt_historyperpage' => "Number of elements on a page in the history of the analysis tool.",
    'toolopt_allwordsforuse' => "<label id='red'>*</label> The total number of words to be processed to identify key words <= 0 - all of the words",
    'toolopt_maxcharscount' => "<label id='red'>*</label> Maximum number of characters to handle, 0 - all",
    'toolopt_maxurlcount' => "<label id='red'>*</label> Maximum number of pages for processing, 0 - no limit",
    'toolopt_maximagesize' => "<label id='red'>*</label> Maximum size of uploaded images in Kb.",
    'toolopt_imagetypes' => "<label id='red'>*</label> List of available images for download (1 per row, the register - the bottom).",
    'toolopt_updateeveryminute' => "<label id='red'>*</label> Update the data every (minutes) 4320 = 3 days.",
    'toolopt_updateifexistsinf' => "Update informer values at the establishment, if the informer of such an identifier (ip, website, etc.) already exists.",
    'toolopt_deleteoldaccminf' => "<label id='red'>*</label> Delete a record of the informer, if a specified number of minutes did not request the informer, 5760 = 4 days, 0 - never delete.",
    'toolopt_checkfordeletels' => "<label id='red'>*</label> Check interval remove obsolete entries, 0 - never check, 150 minutes = 2.5 hours.",
    'toolopt_checkforurlexists' => "Create informers only for existing sites.",    
    'toolopt_keywords' => "Identifier keywords page (empty - uses the main keywords of site).",
    'toolopt_onlyforadmin' => "Provide access to the instrument only to the site administrator.",
    'toolopt_tdescr' => "Html text identifier `detailed` description of the instrument. (shown on page tool icon tool does not clean). (None - use the default description).",
    'toolopt_usemegaindextop' => "Show Black `Site in top by follow keywords` (by www.megaindex.ru)",
    'toolopt_megaindexlogin' => "Login on site www.megaindex.ru",
    'toolopt_megaindexpass' => "Password on site www.megaindex.ru",    
    'toolopt_enabledphistory' => "Enabled params history (pr, cy etc.)",
    'toolopt_updatehistoryifexists' => "Update record in History, if date with this check is exists.",
    'toolopt_showonlyactualy' => "Display history only relevant for this test values. (ie - if there are no attendance at the current test - they will not be displayed on the chart history)",
    'toolopt_grathcount' => "Display on chart N last checks (0 - all checks)",
	//--------------------------- названия параметров инструментов end -----------
    
    //--------------------------- названия идентификаторов параметров begin ------
	'id_cy_value:paramname' => 'Yandex CY',
	'id_pr_value:paramname' => 'Google PR',
    'id_lidaystat_value:paramname' => 'Vasitors per Day by LI',
    'id_limonthstat_value:paramname' => 'Visitors per Month by LI',
    //--------------------------- названия идентификаторов параметров and ------
    
    'showallitemslabel' => 'Show All',
    'graphhelpidentuse' => '<![CDATA[Click on the graph to turn on/off value baloon <br/><br/>Click on legend key to show/hide graph<br/><br/>Mark the area you wish to enlarge]]>',
    'grathtitlelabelid' => '<b>Change History of parameters[%s]</b>',
    
    //--------------------------- динамические надстройки сайта begin -------------
    'defaultsitetitleid' => "Tools for webmasters and SEO, site analysis, testing CY and PR",
    'defaultkeywordssiteid' => "site analysis, tools, webmaster, site position, optimization, verification domain, website promotion, content analysis, whois, pagerang, Tietz, cy, check pr, webmaster, free, promotion, articles, webmaster, tools, website, site promotion",
    'defaultdatetimesiteformat' => "YYYY-mm-dd hh:ii:ss",
    'defaultdatesiteformatid' => "YYYY-mm-dd",
    'defaultdateformatinupdatesid' => "YYYY-mm-dd",
    'defaultdatetimenewshostpageid' => "YYYY-mm-dd at hh:ii",
    
    //описание полей
    'W_DEFAULTDOMAINTITLE_dsc' => "Title of the site by default (appended to the `dynamic` is displayed on the main page).",
    'W_DEFAULTKEYWORDS_dsc' => "Keywords Site by default. (If your keywords have not been overridden for any section).",
    'W_DATETIMEDEFAULTFORMAT_dsc' => "Display format for date/time by default. (system const is: <b>YYYY-mm-dd hh:ii:ss</b>)",
    'W_DATEDEFAULTFORMAT_dsc' => "The date format by default. (system const is: <b>YYYY-mm-dd</b>)",
    'W_ADMENGINEUPDATESFORMATVIEW_dsc' => "The date format in updates on the site. (system const is: <b>YYYY-mm-dd</b>)",
    'W_SITENEWSDATETIMEFORMATONHOST_dsc' => "Display format for date / time of creation of news in the list of the latest news on the home page. (system const is: <b>YYYY-mm-dd at hh:ii</b>)",
    'W_CANBEREGISTERED_dsc' => "Permit the registration of new users",
    'W_HTMLCODEVISIBLECOUNTER_dsc' => "HTML code is `visible` counter web site traffic. (displayed in the lower left corner of the basement). Empty - nothing is displayed.",
    'W_HTMLCODEINVISIBLECOUNTER_dsc' => "HTML code `<b>INVISIBLE</b>` counter web site traffic. (eg for a more accurate collection of statistics). None - the code is not used on the site.",
    'W_HTMLCODERIGHTDOWNBLOCK_dsc' => "HTML code displayed in the right side of the site, followed (below) `news block`",
    'W_HTMLCODETOPCENTERBLOCK_dsc' => "HTML code displayed in the upper central part of the site, followed (below), `strip (path) navigation`",
    'W_HTMLCODEDOWNCENTERBLOCK_dsc' => "HTML code displayed in the lower, central part of the site, before a basement site",
    'W_AUTOCREATEPRUPDATESLIST_dsc' => "Receive updates Google PR automatically (if possible)",
    //--------------------------- динамические надстройки сайта end -------------
    
    'optionsisresetedrestpage' => "Add-in successfully reset! The next time you open a page of the site changes will take effect. At this point you can see in fields previously established identifier at the reopening of this page - the value will be replaced by `system`.",
    
    'noresulttext' => 'no',
    
   );
   
   function __construct(w_Control_obj $control) {
   	$this->control = $control;
   	
   	//имя администратора
   	$this->data['mynameidentifieris'] = 'Eugene';
   	
	    
   	$this->data['bottmessageline'] = 
	 "----------------\r\n".
	 "** Message is sent automatically, respond to it need not! **\r\n".
	 "----------------\r\n\r\n".
	 "Sincerely, {$this->data['mynameidentifieris']}!\r\n".
	 "Administrator http://".W_HOSTMYSITE;
	//-----------------
	
	$this->data['messagefeedbody_listendata'] = 
	 "Message from visitor [%s] from site [%s].\r\n\r\n------ Message data --------\r\n".
	 "Name: [%s]\r\n".
	 "E-mail: [%s]\r\n".
	 "IP: [%s]\r\n\r\n".
	 "Message Subject:\r\n[%s]\r\n\r\n".
	 "Message Text:\r\n[%s]\r\n";
	
	$this->data['newcommentbeaddedtoitem_temp'] =
	"[%s] just added a new commentary for [%s] on site [%s]!\r\n".
	"To view comments click here:\r\n[%s]\r\n\r\n";
	
	$this->data['newcommentbeaddedtoitem'] = 
	 $this->data['newcommentbeaddedtoitem_temp'].$this->data['bottmessageline'];
	
	$this->data['newcommentbeaddedtoitemadmin'] = 
	 $this->data['newcommentbeaddedtoitem_temp']."----Comment text---\r\n[%s]\r\n\r\n".
	 $this->data['bottmessageline'];	
	
	$this->data['addcommenttomoderinform'] = 
	 "You have requested the addition of comments to [[%s]].\r\n\r\n".
	 "Administration of this site requires checking comments before they are published! Your comment will be tested soon. If your comment does not violate the rules - will be published. On placement of your comments will inform you a message with information about your comment.\r\n".
	 $this->data['bottmessageline'];
	
	$this->data['addcommenttomoderinformok'] = 
	 "Your comment to [[%s]] on site [%s] successfully tested and published!\r\n".
	 "To view comments click here:\r\n[%s]\r\n\r\n".$this->data['bottmessageline']; 	 
	
	$this->data['actiontopaynolimit'] = "Do you really want to cancel the test limit?\\r\\nYour account will be charged at the rate of [%s] USD\\r\\nContinue?";
	
	$this->data['setmoneytouser_message_admin'] =
	 "Balance of the user [%s] set to [%s] USD!\r\n".
	 "------------\r\n".
	 "Description of Payment: [%s]\r\n".
	 "Total on User balance: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['setmoneytouser_message'] =
   	 "Dear, [%s]!\r\n".
   	 "Your balance is set to [%s] USD!\r\n".
   	 "The history of financial transactions is available at:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Description of Payment: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];	
	
	$this->data['submoneytouser_message_admin'] =
	 "With the balance of the user [%s] to withdraw the funds in the amount of [%s] USD!\r\n".
	 "------------\r\n".
	 "Description of Payment: [%s]\r\n".
	 "Total on User balance: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['submoneytouser_message'] =
   	 "Dear, [%s]!\r\n".
   	 "Your account account to withdraw funds in the amount of [%s] USD!\r\n".
   	 "The history of financial transactions is available at:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Description of Payment: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];		
	
	$this->data['addmoneytouser_message_admin'] =
	 "User [%s] deposited funds in the amount [%s] USD!\r\n".
	 "------------\r\n".
	 "Description of Payment: [%s]\r\n".
	 "Total on User balance: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['addmoneytouser_message'] =
   	 "Dear, [%s]!\r\n".
   	 "At your expense account received funds in the amount [%s] USD!\r\n".
   	 "The history of financial transactions is available at:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Description of Payment: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];   	
   	
   	$this->data['newmessageonypuraccount'] =
   	 "Dear, [%s]!\r\n".
   	 "You received a new private message on the site ".W_HOSTMYSITE." from User [%s]\r\n\r\n".
   	 "To read the message, click on the link in your Account:\r\n".
   	 "http://".W_HOSTMYSITE."/account/mail/[%s]\r\n\r\n".
   	 "Message info:\r\n".
   	 "Subject: [%s]\r\n".
   	 "Date of sending: [%s]\r\n\r\n".
   	 $this->data['bottmessageline'];
	   	
   	$this->data['filesizenomathon'] =
   	 "File size [[%s] Kb] greater than the maximum allowable size of uploaded file [[%s] Kb] to [[%s] Kb]";
   	 
    $this->data['usernotactive'] = 
	 "Account is not activated! On specified in the registration e-mail sent to re-activate your account code! ".
	 "Check your mail!";
     
	$this->data['activemailtext'] = 
	 "Dear, [%s]\r\n".
	 "\r\n".
	 "To complete registration you need to confirm the existence of your e-mail address!\r\n".
	 "\r\n".
	 "To complete registration please click here\r\n".
	 "[%s]"."\r\n".
	 "or use code: [%s]"."\r\n".
     "on page [%s]"."\r\n".
	 "for manual account activation!\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb'] =
	 "Dear, [%s]!\r\n\r\n".
	 "You, or someone else has used this e-mail to register on the site ".W_HOSTMYSITE."\r\n".
	 "If it were not you - just ignore this message.\r\n\r\n".
	 "-------------\r\n".
	 "Login data info:\r\n".
	 "Login Name: [%s]\r\n".
	 "Password: [%s]\r\n".
	 "Date: [%s]\r\n\r\n".
	 "To be able to log in to your office, you must confirm your e-mail!\r\n".
	 "Для завершения реистрации пройдите по ссылке\r\n".
	 "[%s]"."\r\n".
	 "or use code: [%s]"."\r\n".
     "on page [%s]"."\r\n".
	 "for manual account activation!\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb2'] =
	 "Dear, [%s]!\r\n\r\n".
	 "You, or someone else has used this e-mail to register on the site ".W_HOSTMYSITE."\r\n".
	 "If it were not you - just ignore this message.\r\n\r\n".
	 "-------------\r\n".
	 "Login data info:\r\n".
	 "Login Name: [%s]\r\n".
	 "Password: [%s]\r\n".
	 "Date: [%s]\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb3'] =
	 "Registered a new user: [%s]!\r\n\r\n".
	 "-------------\r\n".
	 "User Data Info:\r\n".
	 "Login Name: [%s]\r\n".
	 "Password: [%s]\r\n\r\n".
	 "E-mail: [%s]\r\n".
	 "IP: [%s]\r\n".
	 "URL: [%s]\r\n".	 
	 "Date: [%s]\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['restmessagepsw'] = 
	 "Dear, [%s]!\r\n".
	 "You have requested to change the password for your account [%s].\r\n\r\n".
	 "----------\r\n".
	 "New Data Info:\r\n".
	 "Login Name: [%s]\r\n".
	 "Password: [%s]\r\n".
	 "----------\r\n\r\n".
	 "To activate the new password, click here:\r\n".
	 "[%s]\r\n".
	 "!!**Important!! Link to activate the new password is valid for the day (current)!\r\n".
	 $this->data['bottmessageline'];	
	 	  	 	
   }//__construct
   
   protected function CorrectList($list, $s) {
   	if (!$list || !@is_array($list)) { return $s; }
	foreach ($list as $val) {
	 $s = @preg_replace("/\[\%s\]/", $val, $s, 1);	 	
	}
	return $s;	
   }//CorrectList
   
   /** проверка существования идентификатора */
   function IdentExists($ident) { return ($ident && isset($this->data[$ident])); }
   
   /** установка идентификатора */
   function AddIdent($ident, $value) { return (!$ident) ? false : ($this->data[$ident] = $value); }
   
   /** альтернативный идентификатор */
   protected function GetUserLangID($ident) {
	if (!$ident = $this->control->CorrectSymplyString($ident)) { return false; }
	$item = $this->control->db->GetLineArray($this->control->db->mPost(
	 "select strsource from {$this->control->tables_list['stringstb']} where strident='$ident' and ".
	 "lang='".$this->control->GetActiveLanguage()."' limit 1"
	));
	return $this->data[$ident] = (!$item) ? false : @stripcslashes($item['strsource']);	
   }//GetUserLangID
   
   /** получение строки по идентификатору */
   function GetLang($name, $list=false, $def=false) {
   	if ($list && !@is_array($list)) { 
	 if (@is_string($list)) { $list = @explode(';', $list); } else { $list = array($list); } 
	}   	
	$value = ($this->IdentExists($name)) ? $this->data[$name] : $this->GetUserLangID($name);
	return ($value === false) ? $def : $this->CorrectList($list, $value);	
   }//GetLang	
	
 }//w_language_obj 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>