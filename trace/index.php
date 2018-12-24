<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
      integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
      crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
      $(function(){
        $('.code-section').click(function(){
          $(this).parent().next('ul').toggle();
        });
      });
    </script>
  </head>
  <body>
    <div class="container theme-showcase jumbotron">
    <?php
	function helper($output, $indentation = '  ') {
      $result = array();
      $path = array();

      foreach ($output as $line) {
        // get depth and label
        $depth = 0;
        while (substr($line, 0, strlen($indentation)) === $indentation) {
          $depth += 1;
          $line = substr($line, strlen($indentation));
        }

        // truncate path if needed
        while ($depth < sizeof($path)) {
          array_pop($path);
        }

        // keep label (at depth)
        $path[$depth] = $line;

        // traverse path and add label to result
        $parent =& $result;
        foreach ($path as $depth => $key) {
          if (!isset($parent[$key])) {
            $parent[$line] = array();
            break;
          }

          $parent =& $parent[$key];
        }
      }

      // return
      return $result;
    }
    function printArrayRecursive($output, $dept = 0){
        ++$dept;
        if (count($output) ===0) {
          return;
        }
        echo '<ul>';
        foreach($output as $k => $v) {
			$kParts=[];
            $kParts = explode(' ',$k);
			$class = $kParts[count($kParts)-1];
			$classArr = explode('\\', $class);
			$method = substr(str_replace($kParts[count($kParts)-1],'',$k),3);
            $element = '<pre>'.'<b>'.$classArr[count($classArr)-1].'</b><br>'.$method.'</pre></a></li>';
            echo '<li>';
            if (count($v) > 0) {
                echo '<a class="code-section">'.$element.'</a>';
            } else {
                echo $element;
            }
            echo '</li>';
            printArrayRecursive($v, $dept);
        }
        echo '</ul>';
        return;
    }
	
	
    $traceFile = __DIR__.'\trace.288638537.xt';
    $fh = fopen($traceFile, 'r');
    $output = [];
    while ($jReadedLine = fgets($fh)) {

      $jReadedLineTransformed = substr($jReadedLine, 26);
      //$spaces = strlen($jReadedLineTransformed)-strlen(ltrim($jReadedLineTransformed));
	  $jReadedLineTransformed = str_replace(array("\n","\r"),'',$jReadedLineTransformed);

      $output[] = $jReadedLineTransformed;
    }

	$transformedOutput = helper($output);
    $c=printArrayRecursive($transformedOutput);
    ?>
  </div>
  </body>
</html>
