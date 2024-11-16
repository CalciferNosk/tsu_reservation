<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TesterController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function test()
	{
	
		var_dump(_getAllCourses());die;


		$teams = ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'];
		$matches = _roundRobin($teams);
		
		foreach ($matches as $match) {
			echo "Match: {$match['team1']} vs {$match['team2']}<br>";	
		}



		echo '<br><br> for single elimination<br>';


		$teams = ['Team A', 'Team B', 'Team C', 'Team D', 'Team E', 'Team F', 'Team G', 'Team H'];
$bracket = _generateBracket($teams);

echo "Round 1:\n";
foreach ($bracket['matches'] as $match) {
    echo "Match: {$match['team1']} vs {$match['team2']}<br>";
}

echo "\nRound 2:\n";
foreach ($bracket['winners'] as $i => $winner) {
    if ($i % 2 == 0) {
        echo "Match: {$winner} vs " . $bracket['winners'][$i + 1] . "\n";
    }
}
	}
}
