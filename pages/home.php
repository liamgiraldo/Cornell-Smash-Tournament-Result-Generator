<?php
$data = open_sqlite_db('secure/site.sqlite');

$show_confirmation = False;
$feedback_displays = array(
  'name' => 'hidden',
  'character' => 'hidden',
  'tournament_name' => 'hidden',
  'tournament_date' => 'hidden',
  'set_count' => 'hidden',
  'placement' => 'hidden'
);

$form_inputs = array(
  'name1' => '',
  'name2' => '',
  'name3' => '',
  'name4' => '',
  'name5' => '',
  'name6' => '',
  'name7' => '',
  'name8' => '',

  'character1' => '',
  'character2' => '',
  'character3' => '',
  'character4' => '',
  'character5' => '',
  'character6' => '',
  'character7' => '',
  'character8' => '',

  'tournament_name' => '',

  'tournament_date' => '',

  'set_count1' => '',
  'set_count2' => '',
  'set_count3' => '',
  'set_count4' => '',
  'set_count5' => '',
  'set_count6' => '',
  'set_count7' => '',
  'set_count8' => '',

  // 'placement1' => '',
  // 'placement2' => '',
  // 'placement3' => '',P
  // 'placement4' => '',
  // 'placement5' => '',
  // 'placement6' => '',
  // 'placement7' => '',
  // 'placement8' => ''
);

$sticky_inputs = array(
  'name1' => '',
  'name2' => '',
  'name3' => '',
  'name4' => '',
  'name5' => '',
  'name6' => '',
  'name7' => '',
  'name8' => '',

  'character1' => '',
  'character2' => '',
  'character3' => '',
  'character4' => '',
  'character5' => '',
  'character6' => '',
  'character7' => '',
  'character8' => '',

  'tournament_name' => '',

  'tournament_date' => '',

  'set_count1' => '',
  'set_count2' => '',
  'set_count3' => '',
  'set_count4' => '',
  'set_count5' => '',
  'set_count6' => '',
  'set_count7' => '',
  'set_count8' => '',

  'placement1' => '',
  'placement2' => '',
  'placement3' => '',
  'placement4' => '',
  'placement5' => '',
  'placement6' => '',
  'placement7' => '',
  'placement8' => ''
);
if(isset($_POST["addresults"])){
  $form_inputs['name1'] = trim($_POST["1name"]);
  $form_inputs['name2'] = trim($_POST["2name"]);
  $form_inputs['name3'] = trim($_POST["3name"]);
  $form_inputs['name4'] = trim($_POST["4name"]);
  $form_inputs['name5'] = trim($_POST["5name"]);
  $form_inputs['name6'] = trim($_POST["6name"]);
  $form_inputs['name7'] = trim($_POST["7name"]);
  $form_inputs['name8'] = trim($_POST["8name"]);

  $form_inputs['character1'] = trim($_POST["1character"]);
  $form_inputs['character2'] = trim($_POST["2character"]);
  $form_inputs['character3'] = trim($_POST["3character"]);
  $form_inputs['character4'] = trim($_POST["4character"]);
  $form_inputs['character5'] = trim($_POST["5character"]);
  $form_inputs['character6'] = trim($_POST["6character"]);
  $form_inputs['character7'] = trim($_POST["7character"]);
  $form_inputs['character8'] = trim($_POST["8character"]);

  $form_inputs['tournament_name'] = trim($_POST["tourneyname"]);
  $form_inputs['tournament_date'] = trim($_POST["tourneydate"]);

  $form_inputs['set_count1'] = trim($_POST["1set"]);
  $form_inputs['set_count2'] = trim($_POST["2set"]);
  $form_inputs['set_count3'] = trim($_POST["3set"]);
  $form_inputs['set_count4'] = trim($_POST["4set"]);
  $form_inputs['set_count5'] = trim($_POST["5set"]);
  $form_inputs['set_count6'] = trim($_POST["6set"]);
  $form_inputs['set_count7'] = trim($_POST["7set"]);
  $form_inputs['set_count8'] = trim($_POST["8set"]);

  $form_valid = True;
  foreach($form_inputs as $form_input => $form_val){
    if($form_val == ''){
      $form_valid = False;
      $feedback_displays[$form_input] = '';
      if(str_contains($form_input, "name") && $form_input != "tournament_name"){
        $feedback_displays['name'] = '';
      }
      if(str_contains($form_input, "character")){
        $feedback_displays['character'] = '';
      }
      if(str_contains($form_input, "set_count")){
        $feedback_displays['set_count'] = '';
      }
    }
  }
  if($form_valid){
    $show_confirmation = True;

    for ($i = 1; $i <= 8; $i++) {
      $result = exec_sql_query(
        $data,
        "INSERT INTO tournament_results (name, placement, character, set_count, tournament_name, tournament_date) VALUES (:name, :placement, :character, :set_count, :tournament_name, :tournament_date);",
        array(
          ':name' => $form_inputs['name'.$i],
          ':placement' => $i,
          ':character' => $form_inputs['character'.$i],
          ':set_count' => $form_inputs['set_count'.$i],
          ':tournament_name' => $form_inputs['tournament_name'],
          ':tournament_date' => $form_inputs['tournament_date']
        )
      );
    }
  }
  else{
    foreach($form_inputs as $form_input => $form_val){
      $sticky_inputs[$form_input] = $form_val;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>CUSSBM Database</title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>
<body>
  <header>
    <p class="left">Cornell SSBM Rank</p>
    <p class="right">&copy;lag288 - 2023<p>
  </header>
  <div class="sitecontent">
    <div class="formwithtext">
      <div class="makerow">
        <h2>Admin Panel</h2>
        <button id="hidepanel">+</button>
      </div>
      <form class="hidden" method="post" action="" novalidate>
        <div class="nameanddate">
          <p class="feedback <?php echo $feedback_displays['tournament_name']; ?>">Tourney name can't be empty.</p>
          <label for="tourneyname_field">Tournament Name:</label>
          <input id="tourneyname_field" type="text" name="tourneyname" value="<?php echo $sticky_inputs['tournament_name']; ?>"/>

          <p class="feedback <?php echo $feedback_displays['tournament_date']; ?>">Tourney date can't be empty.</p>
          <label for="tourneydate_field">Tournament Date:</label>
          <input id="tourneydate_field" type="text" name="tourneydate" value="<?php echo $sticky_inputs['tournament_date']; ?>"/>
        </div>
        <div class="feedbackrow">
            <p class="feedback <?php echo $feedback_displays['name']; ?>">Name(s) invalid</p>

            <p class="feedback <?php echo $feedback_displays['character']; ?>">Character(s) invalid</p>

            <p class="feedback <?php echo $feedback_displays['set_count']; ?>">Set Count(s) invalid</p>
          </div>
        <div class="formrow">
          <div class="inputcol">
            <p>Placement</p>
            <p>1st Place</p>
            <p>2nd Place</p>
            <p>3rd Place</p>
            <p>4th Place</p>
            <p>5th Place</p>
            <p>6th Place</p>
            <p>7th Place</p>
            <p>8th Place</p>
          </div>
          <div class="inputcol">
            <p>Name</p>

            <label for="1name_input"></label>
            <input type="text" id="1name_input" name="1name" value="<?php echo $sticky_inputs['name1']; ?>"/>

            <label for="2name_input"></label>
            <input type="text" id="2name_input" name="2name" value="<?php echo $sticky_inputs['name2']; ?>"/>

            <label for="3name_input"></label>
            <input type="text" id="3name_input" name="3name" value="<?php echo $sticky_inputs['name3']; ?>"/>

            <label for="4name_input"></label>
            <input type="text" id="4name_input" name="4name" value="<?php echo $sticky_inputs['name4']; ?>"/>

            <label for="5name_input"></label>
            <input type="text" id="5name_input" name="5name" value="<?php echo $sticky_inputs['name5']; ?>"/>

            <label for="6name_input"></label>
            <input type="text" id="6name_input" name="6name" value="<?php echo $sticky_inputs['name6']; ?>"/>

            <label for="7name_input"></label>
            <input type="text" id="7name_input" name="7name" value="<?php echo $sticky_inputs['name7']; ?>"/>

            <label for="8name_input"></label>
            <input type="text" id="8name_input" name="8name" value="<?php echo $sticky_inputs['name8']; ?>"/>
          </div>
          <div class="inputcol">
            <p>Character</p>

            <label for="1character_input"></label>
            <select type="text" id="1character_input" name="1character" value="<?php echo $sticky_inputs['character1']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="2character_input"></label>
            <select type="text" id="2character_input" name="2character" value="<?php echo $sticky_inputs['character2']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="3character_input"></label>
            <select type="text" id="3character_input" name="3character" value="<?php echo $sticky_inputs['character3']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="4character_input"></label>
            <select type="text" id="4character_input" name="4character" value="<?php echo $sticky_inputs['character4']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="5character_input"></label>
            <select type="text" id="5character_input" name="5character" value="<?php echo $sticky_inputs['character5']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="6character_input"></label>
            <select type="text" id="6character_input" name="6character" value="<?php echo $sticky_inputs['character6']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="7character_input"></label>
            <select type="text" id="7character_input" name="7character" value="<?php echo $sticky_inputs['character7']; ?>">
            <?php include "includes/characters.php"?>
            </select>

            <label for="8character_input"></label>
            <select type="text" id="8character_input" name="8character" value="<?php echo $sticky_inputs['character8']; ?>">
            <?php include "includes/characters.php"?>
            </select>
          </div>
          <div class="inputcol">
            <p>Set Count</p>

            <label for="1set_input"></label>
            <input type="text" id="1set_input" name="1set" value="<?php echo $sticky_inputs['set_count1']; ?>"/>

            <label for="2set_input"></label>
            <input type="text" id="2set_input" name="2set" value="<?php echo $sticky_inputs['set_count2']; ?>"/>

            <label for="3set_input"></label>
            <input type="text" id="3set_input" name="3set" value="<?php echo $sticky_inputs['set_count3']; ?>"/>

            <label for="4set_input"></label>
            <input type="text" id="4set_input" name="4set" value="<?php echo $sticky_inputs['set_count4']; ?>"/>

            <label for="5set_input"></label>
            <input type="text" id="5set_input" name="5set" value="<?php echo $sticky_inputs['set_count5']; ?>"/>

            <label for="6set_input"></label>
            <input type="text" id="6set_input" name="6set" value="<?php echo $sticky_inputs['set_count6']; ?>"/>

            <label for="7set_input"></label>
            <input type="text" id="7set_input" name="7set" value="<?php echo $sticky_inputs['set_count7']; ?>"/>

            <label for="8set_input"></label>
            <input type="text" id="8set_input" name="8set" value="<?php echo $sticky_inputs['set_count8']; ?>"/>
          </div>
        </div>
        <div class="submitbutton">
          <input type="submit" value="Add Results" name="addresults"/>
        </div>
      </form>
    </div>
    <?php if ($show_confirmation == True){ ?>

      <h2>Results submitted successfuly.</h2>

    <?php } ?>
    <h2>Leaderboards - Recent</h2>
    <div class="leaderboard">
      <div class="leaderboardlinks">
        <div class="leaderlink">
          <button id="hideoverall">Overall</button>
        </div>
        <div class="vl"></div>
        <div class="leaderlink">
          <button id="hiderecent">Recent</button>
        </div>
      </div>
      <?php
        $result = exec_sql_query($data, 'SELECT * FROM tournament_results');

        $tourneydata = $result->fetchAll();
      ?>
      <div id="leaderboardoverall" class="hidden">
        <h2>Overall is a work in progress.</h2>
        <p>Check back in a few weeks for more updates! For now please see <em>recent results.</em></p>
      </div>
      <?php
      $names = array();
      $dates = array();
      foreach ($tourneydata as $tdata){
        $names[] = $tdata['tournament_name'];
        $dates[] = $tdata['tournament_date'];
      }
      $uniquenames = array();
      $uniquedates = array();
      foreach ($names as $name){
        if (!in_array($name, $uniquenames)){
          $uniquenames[] = $name;
        }
      }
      foreach ($dates as $date){
        if (!in_array($date, $uniquedates)){
          $uniquedates[] = $date;
        }
      }
      $fixeddates = array();
      foreach ($uniquedates as $date){
        $tempdate = "";
        if(strlen($date) % 2 == 0){
          $tempdate = $date[0] . $date[1]. '/' . $date[2] . $date[3] . '/' . substr($date, -2);
        }
        else{
          $tempdate = $date[0] . '/' . substr($date, 1, 2) . '/' . substr($date, 3, 4);
        }
        $fixeddates[] = $tempdate;
      }
      $datenamepairs = array();
      for($i = 0; $i < count($uniquenames); $i++){
        $datenamepairs[] = $uniquenames[$i] . ' - ' . $fixeddates[$i];
      }
      ?>
      <?php foreach ($datenamepairs as $datename){?>
        <h2><?php echo htmlspecialchars($datename);?></h2>
        <div id="leaderboardrecent" class="leaderboardresults">
          <div class="individualresult leaderboardlabel">
              <p>Rank</p>
              <p>Name</p>
              <p>Character</p>
              <p>Set Count</p>
          </div>
          <?php foreach ($tourneydata as $tdata) {?>
            <?php if(str_contains($datename, $tdata['tournament_name'])){?>
            <div class="individualresult">
              <p><?php echo htmlspecialchars ($tdata['placement']); ?> </p>
              <p><?php echo htmlspecialchars ($tdata['name']); ?> </p>
              <p><?php echo htmlspecialchars ($tdata['character']); ?> </p>
              <p><?php echo htmlspecialchars ($tdata['set_count']); ?> </p>
            </div>
            <?php }?>
            <?php }?>
        </div>
        <?php }?>
    </div>
    <script src="/public/scripts/jquery-3.6.1.js"></script>
    <script src="/public/scripts/hidepanel.js"></script>
  </div>
</body>

</html>
