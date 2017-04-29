<?php
/**
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, MINI3 - an extremely simple naked PHP application
 * Copyright (c) 2016, canchito-dev (http://www.canchito-dev.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @author 		Panique
 * @copyright	Copyright (c) 2016, MINI3 - an extremely simple naked PHP application
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/panique/mini3
 * 
 * @author 		Jose Carlos Mendoza Prego
 * @copyright	Copyright (c) 2016, canchito-dev (http://www.canchito-dev.com)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/canchito-dev/mini-framework-mvc
 **/
namespace Application\Model;

use Application\Libs\Database;
use \PDO;

class Songs {
	
    public function __construct()  {}
	
	public function __destruct() {}

    /**
     * Add a song to database
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     **/
    public function addSong($artist, $track, $link) {
    	// get a database instance
    	$db = new Database\Database();
    	
    	//connect to database
    	$db = $db->connect();
    	
    	$id = $db->query()
    	->from('songs')
    	->insert(array(
    			'artist' => $artist,
    			'track' => $track,
    			'link' => $link
    	));
    	
    	//disconnect from database
    	$db->disconnect();    
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $songId Id of song
     **/
    public function deleteSong($songId) {
    	// get a database instance
    	$db = new Database\Database();
    	
    	//connect to database
    	$db = $db->connect();
    	
    	$song = $db->query()
    	->from('songs', array(
    			'id',
    			'artist',
    			'track',
    			'link'
    	))
    	->where('id = ?', $songId)
    	->delete();
    	
    	//disconnect from database
    	$db->disconnect();
    }
	
    /**
     * Get all songs from database
     **/
    public function getAllSongs() {
    	// get a database instance
    	$db = new Database\Database();
    	
    	//connect to database
    	$db = $db->connect();
    	
    	$all = $db->query()
	    	->from('songs', array(
	    			'id',
	    			'artist',
	    			'track',
	    			'link'
	    	))
	    	->order('songs.id')
    		->get();
    		
    	//disconnect from database
    	$db->disconnect();
    	
    	return $all;
    }
    
    public function listSongs($limit, $page = 1) {
    	$offset = $limit * ($page - 1);
    
    	// get a database instance
    	$db = new Database\Database();
    
    	//connect to database
    	$db = $db->connect();
    
    	$rows = $db->query()->execute(
    			'SELECT SQL_CALC_FOUND_ROWS `songs`.`id`, `songs`.`artist`, `songs`.`track`,
    			`songs`.`link` FROM `db_mini`.`songs` ORDER BY `songs`.`id` ASC
				LIMIT ' . $offset . ',' . $limit . ';'
    			);
    
    	$songs = array();
    	$count = 0;
    
    	if($rows != false) {
    		for ($i = 0; $i < $rows->rowCount(); $i++)
    			$songs[] = $rows->fetch(PDO::FETCH_ASSOC);
    	}
    
    	$rows = $db->query()->execute('SELECT FOUND_ROWS();');
    	if($rows != false)
    		$count = $rows->fetch(PDO::FETCH_NUM)[0];
    
    		$result = array(
    				'rows' => $songs,
    				'total' => $count
    		);
    
    		//disconnect from database
    		$db->disconnect();
    
    		return $result;
    }

    /**
     * Get a song from database
     **/
    public function getSong($songId) {
    	// get a database instance
    	$db = new Database\Database();
    	 
    	//connect to database
    	$db = $db->connect();
    	 
    	$song = $db->query()
    	->from('songs', array(
    			'id',
    			'artist',
    			'track',
    			'link'
    	))
    	->where('id = ?', $songId)
    	->get();
    	 
    	//disconnect from database
    	$db->disconnect();
    	 
    	return $song;
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $songId Id
     **/
    public function updateSong($artist, $track, $link, $songId) {
    	// get a database instance
    	$db = new Database\Database();
    	
    	//connect to database
    	$db = $db->connect();
    	
    	$id = $db->query()
    	->from('songs')
    	->where('id = ?', $songId)
    	->update(array(
    			'artist' => $artist,
    			'track' => $track,
    			'link' => $link
    	));
    	
    	//disconnect from database
    	$db->disconnect();
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     **/
    public function getAmountOfSongs() {
    	// get a database instance
    	$db = new Database\Database();
    	 
    	//connect to database
    	$db = $db->connect();
    	 
    	$count = $db->query()
    	->from('songs')
    	->count();
    	 
    	//disconnect from database
    	$db->disconnect();
    	
    	return $count;
    }
}
