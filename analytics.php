<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Classes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <?php include 'includes/nav.php';
  if ($_SESSION['usertype']>0) {?>
   <div class="row">
     <div id="sidebar" class="col m2 blue darken-3">
       <h5 class="white-text">Classes</h5>
       <ul>
         <?php
           include "php/functions.php";
           $db = createConnection();
           $query= "select classid from class;";
           $stmt = $db->prepare($query);
     			 $stmt->execute();
     			 $stmt->store_result();
           $stmt->bind_result($classid);
           while ($stmt->fetch()) {
             echo '
             <li><a class="white-text" href="classes.html">Class '.$classid.'</a></li>
             ';
           }
           $stmt->close();
           $db->close();
         ?>
       </ul>
     </div>
   </div>
   <div class="row">
     <div class="col m8 offset-m3">
       <h3>Class 1</h3>
     </div>
     <div id="mainContent" class="col m8 offset-m3">
       <div class="row">
         <canvas id="pieChart"></canvas>
         <canvas id="pieKey"></canvas>
         <script>
          var graphStyle = [200,200,100,"Arial"];
           <?php
             $db = createConnection();
             $query= "select sum(studentid) from studentanswer inner join answercomp on studentanswer.studentanswerid = answercomp.studentanswerid inner join qsexam on qsexam.questionid = studentanswer.questionid where qsexam.testid = 1 && qsexam.questionid = 1 && answercomp.satisfactoryTF = true;";
             $stmt = $db->prepare($query);
       			 $stmt->execute();
       			 $stmt->store_result();
             $stmt->bind_result($sum);
             while ($stmt->fetch()) {
               $classCount = 30;
               if ($sum == null) {
                 $sum = 0;
               }
               echo 'var graphData =[["Right",'.$sum.',"blue"],["Wrong",';
               echo $classCount-$sum.',"orange"]];';
             }
             $stmt->close();
             $db->close();

           ?>
         </script>
        </div>
        <script src="js/pieChart.js"></script>

        <?php
          $db = createConnection();
          $query= "select count(question.questionid) from question inner join qsexam on question.questionid = qsexam.questionid where testid = 1";
          $stmt = $db->prepare($query);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($noQuestions);
          while ($stmt->fetch()) {
            if ($noQuestions == null) {
              $noQuestions = 0;
            }
            $noQuestions = $noQuestions;
          }
          $stmt->close();
          $db->close();
          echo '<p>'.$noQuestions.' Questions</p>';
          $data = array();

          for ($i = 1;$i<=$noQuestions;$i++) {
            $db = createConnection();
            $query= "select studentanswer.studentid, answercomp.satisfactoryTF from studentanswer inner join answercomp on studentanswer.studentanswerid = answercomp.studentanswerid inner join qsexam on qsexam.questionid = studentanswer.questionid where qsexam.testid = 1 && qsexam.questionid =".$i;
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($studentid,$satisfactory);
            while ($stmt->fetch()) {
              if (sizeof($data) == 0) {
                $data[sizeof($data)] = $studentid;
                $data[sizeof($data)] = $satisfactory;
              } else {
                for ($j=0;$j<sizeof($data);$j++) {
                  if ($data[$j] == $studentid) {
                    $data[$j+1]+=$satisfactory;
                    $isThere = true;
                  }
                }
                if (!$isThere) {
                    $data[sizeof($data)] = $studentid;
                    $data[sizeof($data)] = $satisfactory;
                }
              }


            }
            $stmt->close();
            $db->close();
          }
          //Crunch data to work in context of graph plugin
          for ($k=1;$k<=sizeof($data);$k+=2) {
            $data[$k] = ($data[$k]/$noQuestions)*100;
          }

          $data2 = $data;
          $data = array();
          for ($k=1;$k<=sizeof($data2);$k+=2) {
            $data[$l] = $data2[$k];
            $l++;
          }
          ?>
          <canvas id="graph" width="645px" height="300px"></canvas>
          <script>
          var month = 'december';
          <?php
          echo 'var pageHits = [';
          for ($k=null;$k<sizeof($data);$k++) {
            echo $data[$k];
            if ($k != sizeof($data)-1) {
              echo ',';
            }
          }
          echo '];';
        ?>
        for (i=0;i<pageHits.length;i++) {
          pageHits[i] = parseInt(pageHits[i]);
        }
      </script>
      <script src="js/graph.js"></script>
      <?php
        /*$percs = array();
        for ($i=null;$i<sizeof($data);$i++) {

          if ($data[$i] >75 && $data[$i] < 100) {
            $percs[null]++;
          } else if ($data[$i] >50 && $data[$i] <= 75) {
            $percs[1]++;
          } else  if ($data[$i] >0 && $data[$i] <=50){
            $percs[2]++;
          } else {
            echo $data[$i];
          }
        }
        print_r($percs);
        $percs[null] = ($percs[null]/sizeof($data))*100;
        $percs[1] = ($percs[1]/sizeof($data))*100;
        $percs[2] = ($percs[2]/sizeof($data))*100;

        echo '
        <p>76-100 '.$percs[null].'</p>
        <p>51-75 '.$percs[1].'</p>
        <p>0-50 '.$percs[2].'</p>
        ';*/
      ?>
     </div>
   </div>
  <?php } else { ?>
   <p>You do not have access to view this page</p>
  <?php } ?>
</body>
</html>
