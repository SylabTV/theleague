<?php
require "models/Game.php";
require "models/Media.php";
require "models/Player.php";
require "models/PlayerPerformance.php";
require "models/Team.php";

require "managers/AbstractManager.php";
require "managers/GameManager.php";
require "managers/MediaManager.php";
require "managers/PlayerManager.php";
require "managers/PlayerPerformanceManager.php";
require "managers/TeamManager.php";

require "controllers/AbstractController.php";
require "controllers/HomeController.php";
require "controllers/GameController.php";
require "controllers/MediaController.php";
require "controllers/PlayerController.php";
require "controllers/PlayerPerformanceController.php";
require "controllers/TeamController.php";

require "services/Router.php";

?>