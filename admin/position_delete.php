<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>|| MZALENDO SYSTEM ||</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
<link href="../default.css" rel="stylesheet" type="text/css" />
</head>
<?php
require('qs_connection.php');
require('qs_functions.php');
@session_start();

$err_string = "";
$quotechar = "`";
$quotedate = "'";
$sql = "";
$sql_ext = "";
$fields = array();
$fields[0] = "`position`.`position`";
$fields[1] = "`position`.`IDNo`";
$fields[2] = "`position`.`Limit`";
$fields = array();
$fields[0] = "`position`.`position`";
$fields[1] = "`position`.`IDNo`";
$fields[2] = "`position`.`Limit`";

$fieldcons = array();
$fieldcons[0] = "`position`.`position`";
$fieldcons[1] = "`position`.`IDNo`";
$fieldcons[2] = "`position`.`Limit`";

$sql .= " Select\n";
    $sql .= "     `position`.`position`,\n";
    $sql .= "     `position`.`IDNo`,\n";
	$sql .= "     `position`.`Limit`\n";
    $sql .= " From\n";
    $sql .= "     `position`   `position`\n";

if (strpos(strtoupper($sql), " WHERE ")) {
   $sqltemp = $sql . " AND (1=0) ";
}else{
   $sqltemp = $sql . " Where (1=0) ";
}
//Field Related Declarations
$req_Position        = "del_fd0";
$req_Noparticipant   = "del_fd1";

//Assign Recordset Field Index
$rs_idx_position     = 0;
$rs_idx_noparticipant = 1;

$result = mysql_query($sqltemp . " " . $sql_ext . " limit 0,1")
          or die("Invalid query");
if (!$result){
}

$qry_string = "";
$value_sql = "";
$currentrow_sql = "";
$hidden_tag = "";
$hiddenrow_tag = "";
$i = 0;
while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result);
    $field_name = $meta->name;
    $field_type = $meta->type;
    $type_field = "";
    $type_field = returntype($field_type);
    $quotedata = "";
    switch ($type_field) {
      case "type_datetime": $quotedata = $quotedate; break;
      case "type_string": $quotedata = "'"; break;
      case "type_integer": $quotedata = ""; break;
      case "type_unknown": $quotedata = "'"; break;
      default: $quotedata = "'";
    } 
    if (qsrequest("currentrow_fd" .$i) != "") {
        if ($currentrow_sql == "") {
            $currentrow_sql  = $fields[$i] . " = " . $quotedata . qsrequest("currentrow_fd" . $i) . $quotedata . "";
        } else {
            $currentrow_sql .= " and " . $fields[$i] . " = " . $quotedata . qsrequest("currentrow_fd" . $i) . $quotedata . "";
        }
        $hiddenrow_tag .= "<input type=\"hidden\" name=\"currentrow_fd" . $i . "\" value=\"" . qsrequest("currentrow_fd" . $i) . "\">\n";
    }
    $i++;
}
//Create recordset data 
    if ($result > 0) {mysql_free_result($result);}
    $sql = "";
$sql .= " Select\n";
    $sql .= "     `position`.`position`,\n";
    $sql .= "     `position`.`IDNo`,\n";
	$sql .= "     `position`.`Limit`\n";
    $sql .= " From\n";
    $sql .= "     `position`   `position`\n";
    $sql .= " where ".$currentrow_sql ;

    $result =  mysql_query($sql) or die("Invalid query");
    if (!$result){

    }
    $row = mysql_fetch_array($result);

//Check form submit 
if (isset($_POST["act"])) {

    $sql  = "";
    $sql  = "delete from " . $quotechar. mysql_field_table($result,0) . $quotechar;
    $sql .= " where ";
    $sql .= qsreplace_backslashes(stripslashes($currentrow_sql));

#----get submit url page----
    $submiturl = "./position.php?";
    if ($result > 0) {mysql_free_result($result);}
    if ($err_string == "") {
    if (!$result = @mysql_query($sql)){
        $err_string .= "<strong>Error:</strong>while updating<br>" . mysql_error();
    } else { 

    }
    if ($err_string == "") {
        if ($qry_string != "") {
            $URL= $submiturl . "&" . $qry_string;
        } else {
            $URL= $submiturl;
        }
            header ("Location: $URL");
            exit;
        }
    }
} //end if act
?>
<script type="text/javascript" src="./js/yahoo-min.js" ></script>
<script type="text/javascript" src="./js/dom-min.js" ></script>
<script type="text/javascript" src="./js/event-min.js" ></script>

<script type="text/javascript">

  // Invoke dbQwikSite Page OnLoad controller as soon as the page is ready 
  // This should always happen first, any user custom-code should run after
  YAHOO.util.Event.onDOMReady( function() { qsPageOnLoadController(); } );  

</script>

	<link rel="stylesheet" type="text/css" href="./css/ContentLayout.css"></link>


<!-- END OF STD-Loader.txt -->


<script type="text/javascript">

// Declares all constants and arrays
// for all page items used on the page

// Declare Field Indexes for all page items
var qsPageItemsCount = 2
var _Position                                 = 0;
var _Noparticipant                            = 1;

// Declare Fields Prompts
var fieldPrompts = [];
fieldPrompts[_Position] = "Position";
fieldPrompts[_Noparticipant] = "Noparticipant";

// Declare Fields Technical Names
var fieldTechNames = [];
fieldTechNames[_Position] = "Position";
fieldTechNames[_Noparticipant] = "Noparticipant";

// This function dynamically assigns element 'ID' attributes to all relevant elements
function qsAssignElementIDs() {

  // STEP 1: Assign an ID to all field PROMPTS (TD captions)
  // Scan all table TD tags for those that match field prompts
  var TDs = document.getElementsByTagName("td");
  for (var i=0; i < TDs.length; i++) {
    var element = TDs[i];
    // Check if the TD found is one of the Page Items header
    // This can only be an approximation as some TDs other than the actual field prompts
    // may contain the same caption. In that case all TDs found will carry the same ID.
    if (element.className == "ThRows" || element.className == "TrOdd") {
      for (var f=0; f < qsPageItemsCount; f++) {
        if (element.innerHTML == fieldPrompts[f]) {
            element.id = fieldTechNames[f] + "_caption_cell";
          element.innerHTML = "<div id='" + fieldTechNames[f] + "_caption_div'>" + element.innerHTML + "</div>";
        }
      }
    }
  }

  // STEP 2: Assign an ID to all Input controls on the form
}


function qsPageItemsAbstraction() {
  qs_form                                  = document.getElementsByName("qs_delete_form")[0];   //Define Form Object by Name.


}

</script>



<script type="text/javascript">

// This function dynamically assigns custom events
// to page item controls on this page
function qsAssignPageItemEvents() {
}

</script>

<script>

function usrEvent__Delete_Position__onload() {
  // >> START OF "Delete Position -> On Load" [onload] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
  // << END OF "Delete Position -> On Load" [onload] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
}



function usrEvent__Delete_Position__onunload() {
  // >> START OF "Delete Position -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
  // << END OF "Delete Position -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
}



function usrEvent__Delete_Position__onresize() {
  // >> START OF "Delete Position -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
  // << END OF "Delete Position -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
}



// This function controls the OnUnload event dispatching
function qsPageOnUnloadController() {   
}



// This function controls the OnResize event dispatching
function qsPageOnResizeController() {   
   var lastResult = false                              
   return true;                                        
}                                                      



// This function controls the OnLoad events dispatching
function qsPageOnLoadController() {   
   var lastResult = false                              

   // Invoke the technical field names abstraction initialization
   qsPageItemsAbstraction();


   // Invoke the Element IDs assignment function
   qsAssignElementIDs();

   // Invoke the Page Items custom events assignments
   qsAssignPageItemEvents();
   // Assign Event Handlers for page-level events
   YAHOO.util.Event.addListener(window, "beforeunload", qsPageOnUnloadController);
   YAHOO.util.Event.addListener(window, "resize", qsPageOnResizeController);
   // Set focus on first enterable page item available

   return true;                                        
}                                                      





function usrEvent__Delete_Position__onsubmit(frm) {
  // >> START OF "Delete Position -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
  // << END OF "Delete Position -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
}



function usrEvent__Delete_Position__onreset() {
  // >> START OF "Delete Position -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
  // << END OF "Delete Position -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [924D5DBD-885A-4F85-B501-03C5A88DE02E]
}



// This function controls the OnSubmit event dispatching
function qsFormOnSubmitController(frm) {                 
   var lastResult = false                              
   return true;                                        
}                                                      



// This function controls the OnReset event dispatching
function qsPageOnResetController() {   
   var lastResult = false                              
   return true;                                        
}                                                      


</script>

<body>
<div id="header">
</div>
<div id="menu" align="center">
	<ul>
		<li><a href="../index.php">|  Home  |</a></li>
		<li><a href="../user_login.php">|  Voting  |</a></li>
		<li><a href="../result.php">|  Result  |</a></li>
		<li><a href="index.php">|  Backend  |</a></li>
		<li><a href="../contact.php">|  Contact Us  |</a></li>
        <li><a href="home.php">|  Logout  |</a></li>
	</ul>
</div>
<div id="content">
	<div class="button" id="left">
    <Center>
<center><hr /><font size="5">
Delete Position
</font><hr /></center><br>
    </div>
	
	<br><br><br><br>
<div id="nav" align="center">
	<ul>
		<li><a href="position.php">|Position Info|</a></li>
		<li><a href="candidate.php">|Candidate Info|</a></li>
		<li><a href="students.php">|Voters Info|</a></li>
		<li><a href="tally.php">|Vote Analisys|</a></li>
        
	</ul>
</div>
<table id="QS_Content_Layout_1_Table" align="center">
  <tr id="QS_Content_Layout_1_TopRow">
    <td id="QS_Content_Layout_1_NorthWest">
            <div id="QS_Content_Layout_1_NorthWestDiv">
        </div>
    </td>
    <td id="QS_Content_Layout_1_North">
            <div id="QS_Content_Layout_1_NorthDiv">
        </div>
    </td>
    <td id="QS_Content_Layout_1_NorthEast">
            <div id="QS_Content_Layout_1_NorthEastDiv">
        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_MiddleRow">
    <td id="QS_Content_Layout_1_West">
            <div id="QS_Content_Layout_1_WestDiv">
        </div>
    </td>
    <td id="QS_Content_Layout_1_Center">
            <div id="QS_Content_Layout_1_CenterDiv">

<Form name="qs_delete_form" method="post" action="./position_delete.php" onSubmit="return qsFormOnSubmitController(this)"  onReset="return qsPageOnResetController(this)" >
<?php
print $hidden_tag;
print $hiddenrow_tag;
?>
<table border="0" cellpadding="2" cellspacing="1" bgcolor="#D4D4D4">
  <?php
$css_class = "\"TrOdd\"";
?>
  <tr>
    <td colspan="2" class="ThRows"><strong>Delete Position</strong></td>
  </tr>
  <?php
if ($err_string != "") {
    print "<tr>";
    print "<td class=\"ThRows\"><Strong>Error:</Strong></td>";
    print "<td class=" . $css_class . " align=Default>" . $err_string . "</td>";
    print "</tr>";
}
?>
  <tr>
    <td class="ThRows">Position</td>
    <?php
$itemvalue = "" . $row[0] . "";
if ($itemvalue == "") {
    $itemvalue = "&nbsp;";
}

    $cellvalue =  $itemvalue;
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }
    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
  </tr>
  <tr>
    <td class="ThRows">P.ID</td>
    <?php
$itemvalue = "" . number_format($row[1],0,".",",") . "";
if ($itemvalue == "") {
    $itemvalue = "&nbsp;";
}

    $cellvalue =  $itemvalue;
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }
    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
  </tr>
  <?php
#----get back url page----
  $backurl = "./position.php?";
?>
  <tr>
    <td class="ThRows">&nbsp;</td>
    <td class="TrOdd" align=Default><input type="hidden" name="act" value="n" />
      <input name="QS_Back" type="button" class="button" onclick="javascript:window.location='<?php print $backurl; ?>'" value="Back" />
      &nbsp;&nbsp;
      <input name="QS_Submit" type="submit" class="button" value="Delete" />
      &nbsp;&nbsp; </td>
  </tr>
</table>
<br>

</Form>
<?php
if ($result > 0) {mysql_free_result($result);}
if ($link > 0) {mysql_close($link);}
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_East">
            <div id="QS_Content_Layout_1_EastDiv">
        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_BottomRow">
    <td id="QS_Content_Layout_1_SouthWest">
            <div id="QS_Content_Layout_1_SouthWestDiv">
        </div>
    </td>
    <td id="QS_Content_Layout_1_South">
            <div id="QS_Content_Layout_1_SouthDiv">
        </div>
    </td>
    <td id="QS_Content_Layout_1_SouthEast">
            <div id="QS_Content_Layout_1_SouthEastDiv">
        </div>
    </td>
  </tr>
</table>
</div>
<p>&nbsp;</p>
<div id="footer">
	<p>Copyright &copy; 2019 Designed by <a href="http://www.charlesmbuvi.com" class="link1">Charles Mbuvi</a></p>
</div>
</body>
</html>
