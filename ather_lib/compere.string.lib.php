<?php
// $comp = new StringMatch();
// print 'Match: '.$comp->Compere('Это вот мой дом','да, это и мой дом тоже, хата домик').'%';
//
 //---------------------------------------------------------
 define("SNAKE_LIMIT",	20);
 define("INT_MAX" , 2147483647);

 class StringMatch {
  private $string = array();
  private $max_edits = 0; 
  private $heuristic = 0;
  private $fdiag;
  private $bdiag;
  private $too_expensive;
  private $partition = array();
  private $timedata  = 0; //for write time

 function diag ($xoff, $xlim, $yoff, $ylim, $minimal, &$part) {
  $fd = $this->fdiag;	/* Give the compiler a chance. */
  $bd = $this->bdiag;	/* Additional help for the compiler. */
  $xv = $this->string[0]["data"];	/* Still more help for the compiler. */
  $yv = $this->string[1]["data"];	/* And more and more . . . */

  $dmin = $xoff - $ylim;	/* Minimum valid diagonal. */
  $dmax = $xlim - $yoff;	/* Maximum valid diagonal. */
  $fmid = $xoff - $yoff;	/* Center diagonal of top-down search. */
  $bmid = $xlim - $ylim;	/* Center diagonal of bottom-up search. */

  $fmin = $fmid;
  $fmax = $fmid;		/* Limits of top-down search. */
  $bmin = $bmid;
  $bmax = $bmid;		/* Limits of bottom-up search. */
  $odd = ($fmid - $bmid) & 1;

  $fd[$fmid] = $xoff;
  $bd[$bmid] = $xlim;
  for ($c = 1;; ++$c)
    {
      //$d;			/* Active diagonal. */
      $big_snake = 0;
      /* Extend the top-down search by an edit step in each diagonal. */
      if ($fmin > $dmin)
	$fd[--$fmin - 1] = -1;
      else
	++$fmin;
      if ($fmax < $dmax)
	$fd[++$fmax + 1] = -1;
      else
	--$fmax;
      for ($d = $fmax; $d >= $fmin; $d -= 2)
	{
	  $tlo = $fd[$d - 1];
	  $thi = $fd[$d + 1];

	  if ($tlo >= $thi)
	    $x = $tlo + 1;
	  else
	    $x = $thi;
	  $oldx = $x;
	  $y = $x - $d;
	  while ($x < $xlim && $y < $ylim && $xv[$x] == $yv[$y])
	    {
	      ++$x;
	      ++$y;
	    }
	  if ($x - $oldx > SNAKE_LIMIT)
	    $big_snake = 1;
	  $fd[$d] = $x;
	  if ($odd && $bmin <= $d && $d <= $bmax && $bd[$d] <= $x)
	    {
	      $part["xmid"] = $x;
	      $part["ymid"] = $y;
	      $part["lo_minimal"] = $part["hi_minimal"] = 1;
	      return 2 * $c - 1;
	    }
	}
      /* Similarly extend the bottom-up search.  */
      if ($bmin > $dmin)
	$bd[--$bmin - 1] = INT_MAX;
      else
	++$bmin;
      if ($bmax < $dmax)
	$bd[++$bmax + 1] = INT_MAX;
      else
	--$bmax;
      for ($d = $bmax; $d >= $bmin; $d -= 2)
	{

	  $tlo = $bd[$d - 1];
	  $thi = $bd[$d + 1];
	  if ($tlo < $thi)
	    $x = $tlo;
	  else
	    $x = $thi - 1;
	  $oldx = $x;
	  $y = $x - $d;
	  while ($x > $xoff && $y > $yoff && $xv[$x - 1] == $yv[$y - 1])
	    {
	      --$x;
	      --$y;
	    }
	  if ($oldx - $x > SNAKE_LIMIT)
	    $big_snake = 1;
	  $bd[$d] = $x;
	  if (!$odd && $fmin <= $d && $d <= $fmax && $x <= $fd[$d])
	    {
	      $part["xmid"] = $x;
	      $part["ymid"] = $y;
	      $part["lo_minimal"] = $part["hi_minimal"] = 1;
	      return 2 * $c;
	    }
	}

      if ($minimal)
	continue;

#ifdef MINUS_H_FLAG
      /* Heuristic: check occasionally for a diagonal that has made lots
         of progress compared with the edit distance.  If we have any
         such, find the one that has made the most progress and return
         it as if it had succeeded.

         With this heuristic, for strings with a constant small density
         of changes, the algorithm is linear in the strings size.  */
      if ($c > 200 && $big_snake && $heuristic)
	{

	  $best = 0;
	  for ($d = $fmax; $d >= $fmin; $d -= 2)
	    {

	      $dd = $d - $fmid;
	      $x = $fd[$d];
	      $y = $x - $d;
	      $v = ($x - $xoff) * 2 - $dd;

	      if ($v > 12 * ($c + ($dd < 0 ? -$dd : $dd)))
		{
		  if
		    (
		      $v > $best
		      &&
		      $xoff + SNAKE_LIMIT <= $x
		      &&
		      $x < $xlim
		      &&
		      $yoff + SNAKE_LIMIT <= $y
		      &&
		      $y < $ylim
		    )
		    {
		      /* We have a good enough best diagonal; now insist
			 that it end with a significant snake.  */
		      $k;

		      for ($k = 1; $xv[$x - $k] == $yv[$y - $k]; $k++)
			{
			  if ($k == SNAKE_LIMIT)
			    {
			      $best = $v;
			      $part["xmid"] = $x;
			      $part["ymid"] = $y;
			      break;
			    }
			}
		    }
		}
	    }
	  if ($best > 0)
	    {
	      $part["lo_minimal"] = 1;
	      $part["hi_minimal"] = 0;
	      return 2 * $c - 1;
	    }
	  $best = 0;
	  for ($d = $bmax; $d >= $bmin; $d -= 2)
	    {

	      $dd = $d - $bmid;
	      $x = $bd[$d];
	      $y = $x - $d;
	      $v = ($xlim - $x) * 2 + $dd;

	      if ($v > 12 * ($c + ($dd < 0 ? -$dd : $dd)))
		{
		  if ($v > $best && $xoff < $x && $x <= $xlim - SNAKE_LIMIT &&
		      $yoff < $y && $y <= $ylim - SNAKE_LIMIT)
		    {
		      /* We have a good enough best diagonal; now insist
			 that it end with a significant snake.  */
		      $k;

		      for ($k = 0; $xv[$x + $k] == $yv[$y + $k]; $k++)
			{
			  if ($k == SNAKE_LIMIT - 1)
			    {
			      $best = $v;
			      $part["xmid"] = $x;
			      $part["ymid"] = $y;
			      break;
			    }
			}
		    }
		}
	    }
	  if ($best > 0)
	    {
	      $part["lo_minimal"] = 0;
	      $part["hi_minimal"] = 1;
	      return 2 * $c - 1;
	    }
	}
#endif /* MINUS_H_FLAG */
      /* Heuristic: if we've gone well beyond the call of duty, give up
	 and report halfway between our best results so far.  */
      if ($c >= $this->too_expensive) {
	  /* Pacify `gcc -Wall'. */
	  $fxbest = 0;
	  $bxbest = 0;
	  /* Find forward diagonal that maximizes X + Y.  */
	  $fxybest = -1;
	  for ($d = $fmax; $d >= $fmin; $d -= 2)
	    {

	      $x = $fd[$d] < $xlim ? $fd[$d] : $xlim;
	      $y = $x - $d;

	      if ($ylim < $y)
		{
		  $x = $ylim + $d;
		  $y = $ylim;
		}
	      if ($fxybest < $x + $y)
		{
		  $fxybest = $x + $y;
		  $fxbest = $x;
		}
	    }
	  /* Find backward diagonal that minimizes X + Y.  */
	  $bxybest = INT_MAX;
	  for ($d = $bmax; $d >= $bmin; $d -= 2)   {
	      $x = $xoff > $bd[$d] ? $xoff : $bd[$d];
	      $y = $x - $d;

	      if ($y < $yoff) {
		  $x = $yoff + $d;
		  $y = $yoff;
		  }
	      if ($x + $y < $bxybest) {
		  $bxybest = $x + $y;
		  $bxbest = $x;
		  }
	    }
	  /* Use the better of the two diagonals.  */
	  if (($xlim + $ylim) - $bxybest < $fxybest - ($xoff + $yoff))  {
	      $part["xmid"] = $fxbest;
	      $part["ymid"] = $fxybest - $fxbest;
	      $part["lo_minimal"] = 1;
	      $part["hi_minimal"] = 0;
	    }
	  else  {
	      $part["xmid"] = $bxbest;
	      $part["ymid"] = $bxybest - $bxbest;
	      $part["lo_minimal"] = 0;
	      $part["hi_minimal"] = 1;
	    }
	  return 2 * $c - 1;
	}
    }
 }


/* NAME
	compareseq - find edit sequence

   SYNOPSIS
	void compareseq(int xoff, int xlim, int yoff, int ylim, int minimal);

   DESCRIPTION
	Compare in detail contiguous subsequences of the two strings
	which are known, as a whole, to match each other.

	The subsequence of string 0 is [XOFF, XLIM) and likewise for
	string 1.

	Note that XLIM, YLIM are exclusive bounds.  All character
	numbers are origin-0.

	If MINIMAL is nonzero, find a minimal difference no matter how
	expensive it is.  */
 function compareseq ($xoff, $xlim, $yoff, $ylim, $minimal) {
  $xv = $this->string[0]["data"];	/* Help the compiler.  */
  $yv = $this->string[1]["data"];
  if ($this->string[1]["edit_count"] + $this->string[0]["edit_count"] > $this->max_edits) return;
  /* Slide down the bottom initial diagonal. */
  while (($xoff < $xlim) && ($yoff < $ylim) && ($xv[$xoff] == $yv[$yoff])) {
      ++$xoff;
      ++$yoff;
    }
  while ($xlim > $xoff && $ylim > $yoff && $xv[$xlim - 1] == $yv[$ylim - 1]) {
      --$xlim;
      --$ylim;
    }
  if ($xoff == $xlim) {
      while ($yoff < $ylim)	{
	  ++$this->string[1]["edit_count"];
	  ++$yoff;
	}
    } else if ($yoff == $ylim) {
      while ($xoff < $xlim)	{
	  ++$this->string[0]["edit_count"];
	  ++$xoff;
	}
    } else  {
      /* Find a point of correspondence in the middle of the strings.  */
      $c = $this->diag ($xoff, $xlim, $yoff, $ylim, $minimal, $part);
      if ($c == 1) {
	  exit;
	  if ($part["xmid"] - $part["ymid"] < $xoff - $yoff)  ++$this->string[1]["$edit_count"];
	  else  ++$this->string[0]["edit_count"];
	}
      else {
	  /* Use the partitions to split this problem into subproblems.  */
	  $this->compareseq ($xoff, $part["xmid"], $yoff, $part["ymid"], $part["lo_minimal"]);
	  $this->compareseq ($part["xmid"], $xlim, $part["ymid"], $ylim, $part["hi_minimal"]);
	}
    }
 }//compareseq
 /* NAME
	fstrcmp - fuzzy string compare

   SYNOPSIS
	double fstrcmp(const CHAR *s1, int l1, const CHAR *s2, int l2, double);

   DESCRIPTION
	The fstrcmp function may be used to compare two string for
	similarity.  It is very useful in reducing "cascade" or
	"secondary" errors in compilers or other situations where
	symbol tables occur.

   RETURNS
	double; 0 if the strings are entirly dissimilar, 1 if the
	strings are identical, and a number in between if they are
	similar.  */
 function fstrcmp ($string1, $length1, $string2, $length2, $minimum = 0) {
  $fdiag_buf=0;
  $fdiag_max=0;
  /* set the info for each string.  */
  $this->string[0]["data"] = $string1;
  $this->string[0]["data_length"] = $length1;
  $this->string[1]["data"] = $string2;
  $this->string[1]["data_length"] = $length2;
  /* short-circuit obvious comparisons */
  if ($this->string[0]["data_length"] == 0 && $this->string[1]["data_length"] == 0)
    return 1.0;
  if ($this->string[0]["data_length"] == 0 || $this->string[1]["data_length"] == 0)
    return 0.0;
  $this->too_expensive = 1;
  for ($i = $this->string[0]["data_length"] + $this->string[1]["data_length"]; $i != 0; $i >>= 2)
    $this->too_expensive <<= 1;
  if ($this->too_expensive < 256)  $this->too_expensive = 256;
  $fdiag_len = $this->string[0]["data_length"] + $this->string[1]["data_length"] + 3; 
  if ($fdiag_len > $fdiag_max) { $fdiag_max = $fdiag_len;  }
  $this->max_edits = 1 + ($this->string[0]["data_length"] + $this->string[1]["data_length"]) * (1.0 - $minimum);
  $this->string[0]["edit_count"] = 0;
  $this->string[1]["edit_count"] = 0;
  $this->compareseq (0, $this->string[0]["data_length"], 0, $this->string[1]["data_length"], 0);
  return ((double)
             ($this->string[0]["data_length"] + $this->string[1]["data_length"] - $this->string[1]["edit_count"] - $this->string[0]["edit_count"])
           / ($this->string[0]["data_length"] + $this->string[1]["data_length"]));
 }//fstrcmp
 
 function Compere($str1,$str2,$limit = 0.4,$lengthmax=700) {
  $length1 = strlen($str1);
  $length2 = strlen($str2);  
  if ($lengthmax > 0) {
    if ($length1 > $lengthmax) { $str1 = substr($str1,0,$lengthmax); $length1 = $lengthmax; }	
    if ($length2 > $lengthmax) { $str2 = substr($str2,0,$lengthmax); $length2 = $lengthmax; }
  }
  return round(($this->fstrcmp($str1, $length1, $str2, $length2, $limit)*100),2);	
 }//Compere

  //старт засекания времени
  function StartTime() {
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$this->timedata = $mtime[1] + $mtime[0];
  }//StartTime
  
  //получение текущего времени (в секундах)
  function GetCurTimeOfStart() {
   if ($this->timedata == 0) { return 0; }	
   $mtime = microtime();
   $mtime = explode(" ",$mtime);
   $mtime = $mtime[1] + $mtime[0];
   return $mtime - $this->timedata;	
  }//GetCurTimeOfStart
   
 }//StringMatch
//--------------------------------------------------------- 
?>  