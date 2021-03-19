<?php
  session_start();
  include "config.php";
  $data = $_SESSION["data"];
  $all_courses = mysqli_query($conn, "SELECT * FROM courses");


?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Home | Transfer</title>
  <style type="text/css">
    .style1 {
      color: #FFFFFF
    }

    .style3 {
      color: #FFFFFF;
      font-weight: bold;
    }

  </style>
  <link href="dashboard.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">

  <script src="jquery-1.12.4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {


// REMOVING TABLE AND DISPLAYING MESSAGE IF USER HAS SUBMITTED AN APPLICATION
      let params = new URLSearchParams(location.search);
      if(params.get('submitted')=="true"){
        $("#formtable").html("<div class='alert alert-success' role='alert'><p>You have already submitted an application</p></div>");
      }
      else if (params.get('changed') == "success") {
        $("#formtable").html("<div class='alert alert-success' role='alert'><p>CONGRATULATIONS! </p><br/><br/><p>You have successfully changed your course</p><br /><br /><p>You can now go for your new admission letter.</p></div>");

      }
      else if (params.get('submitted') == "error") {
        $("#formtable").html("<div class='alert alert-success' role='alert'><p>Sorry, you do not qualify to the courses you applied for</p><br /><br /><p>Try again later</p></div>");

      }


      $("#select_faculty").change(function () {
        var selected = $(this).children("option:selected").val();
        $.post("courses.php", {
          faculty: selected
        }, function (returned) {
          $("#courses_display").html(returned);
        });

      });

      $("#form_select1").change(function () {
        //
        var selectedfaculty = $(this).children("option:selected").val();

        $.post("get-data.php", {
          selected: selectedfaculty
        }, function (returned) {
          $("#courses1").html(returned);
        });


      });

      $("#form_select2").change(function () {

        var selected2 = $(this).children("option:selected").val();

        $.post("get-data.php", {
          selected: selected2
        }, function (data) {
          $("#courses2").html(data);
          $(this).val("");
        });

      });

      // checking if user wants to transfer to their current course.
      $("#courses1").change(function () {
        var selected = $(this).children("option:selected").val();
        var current = $("#currentcourse").val();
        $.post("check_course.php", {
          selected: selected,
          current: current
        }, function (data) {
          if (data == 1) {
            alert("You cannot transfer to your current course");
            $("#courses1").val("None");
          }
        });
      });


      $("#courses2").change(function () {
        var selected = $(this).children("option:selected").val();
        var current = $("#currentcourse").val();
        $.post("check_course.php", {
          selected: selected,
          current: current
        }, function (data) {
          if (data == 1) {
            alert("You cannot transfer to your current course");
            $("#courses2").val("None");
          }
        });
      });

    });

  </script>

</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-default">
      <div class="navbar-brand">
        <p>LOgo</p>
      </div>
      <form class="navbar-form navbar-right" action="logout.php" method="post">
        <button type="submit" class="btn btn-dark">logout</button>
      </form>
    </nav>
  </div>
  <div class="container">
    <div class="row">




      <div class="col-sm-3">
        <form>
          <h4>Person Details</h4>
          <div class="form-group">
            <label for="person_name">Name</label>
            <input type="text" class="form-control" name="textfield2"
                   value=<?php echo $data["f_name"]." ".$data["s_name"] ?> />
          </div>
          <div class="form-group">
            <label for="textfield">Regno</label>
            <input type="text" class="form-control" name="textfield" value=<?php echo $data["regno"] ?> />
          </div>
          <div class="form-group">
            <label for="textfield5">Faculty</label>
            <input type="text" name="textfield5" class="form-control" value=<?php echo $data["faculty"] ?> />
          </div>
          <div class="form-group">
            <label for="textfield6">Course</label>
            <input id="currentcourse" class="form-control" type="text" name="textfield6" value=<?php

                      $courseid = $data["course"];

                      $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM courses WHERE id = $courseid"));
                      $coursename = $row["coursename"];
                      echo "$coursename";
                      ?> />

          </div>
          <div class="form-group">
            <label for="textfield3">Cluster</label>
            <input type="text" class="form-control" name="textfield3" value=<?php echo $data["cluster_points"] ?> />
          </div>
        </form>
      </div>





      <div class="col-sm-4" id="formtable">
        <form id="form1" name="form1" method="post" action="transfer.php">
          <h4>Transfer Form</h4>
          <h5>First Option</h5>
          <h6>Faculty to transfer to:</h6>
          <select id="form_select1" class="form-control" name="select">
            <option value="none">------Select Faculty-------</option>

            <?php
                            include "config.php";

                            $all_faculties = mysqli_query($conn, "SELECT * FROM faculties");
                            while ($row = mysqli_fetch_assoc($all_faculties)) {
                              echo "<option>".$row['name']."</option>";
                            }

                          ?>

          </select>
          <h6>Course to transfer to:</h6>
          <select id="courses1" name="selectedcourse1" class="form-control">
            <option>------Select Course-------</option>
          </select>
          <br>
          <br>

          <h5>Second option</h5>
          <h6>Faculty to transfer to:</h6>
          <select id="form_select2" name="select3" class="form-control">
            <option>------Select Faculty-------</option>
            <?php
                            include "config.php";

                            $all_faculties = mysqli_query($conn, "SELECT * FROM faculties");
                            while ($row = mysqli_fetch_assoc($all_faculties)) {
                              echo "<option>".$row['name']."</option>";
                            }
                          ?>
          </select>
          <h6>Course to transfer to:</h6>
          <select id="courses2" name="selectedcourse2" class="form-control">
            <option>------Select Course-------</option>
          </select>

          <input type="submit" class="btn btn-default" name="submit" id="submit" value="Submit">


        </form>
      </div>





      <div class="col-sm-5">
        <h5>Cluster Details</h5>
        <h6>Search by faculty:</h6>
        <select id="select_faculty" name="searchbyfaculty" class="form-control">
          <option value="all">------All Faculties-------</option>
          <?php
                        include "config.php";

                        $all_faculties = mysqli_query($conn, "SELECT * FROM faculties");
                        while ($row = mysqli_fetch_assoc($all_faculties)) {
                          echo "<option>".$row['name']."</option>";
                        }
                      ?>
        </select>

        <div class="col-sm-5">
          <table class="table-responsive table-striped table-hover table-condensed" id="courses_display">
            <tbody>
              <tr>
                <td width="15">##</td>
                <td width="120">Course</td>
                <td width="55">Cluster</td>
                <td width="45">Faculty</td>
              </tr>

              <?php
                      $counter = 1;
                      while ($row = mysqli_fetch_assoc($all_courses)) {

                        echo "<tr>";
                        echo "<td width='15'>".$counter."</td>";
                        echo "<td width='120'>".$row['coursename']."</td>";
                        echo "<td width='55'>".$row['cluster_point']."</td>";
                        echo "<td width='45'>".$row['faculty']."</td>";
                        echo "</tr>";

                        $counter ++;
                      }
                  ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
