<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * courses_available block rendrer
 *
 * @package    block_courses_available
 * @copyright  2017 Ian Wild
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

/**
 * Courses_available block rendrer
 *
 * @copyright  2017 Ian Wild
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_courses_available_renderer extends plugin_renderer_base {
    
    /**
     * Returns the HTML for the course title. For now just return the title as-is.
     * 
     * @param unknown $title
     * @return unknown
     */
    public function get_course_title($title) {
        return $title;
    }

    /**
     * Returns the HTML for a button that links to the block_courses_available overview page
     * 
     * @param unknown $course
     * @return string
     */
    public function get_summary($course) {
        
        $html = '-';
        
        if(isset($course->summary)) {
            global $OUTPUT, $CFG;
            
            $link = new moodle_url($CFG->wwwroot.'/blocks/courses_available/overview.php?id='.$course->id);
            $buttonString = get_string('description', 'block_courses_available');
            $button = new single_button($link, $buttonString, 'get');
            $button->class = 'tablebutton';
            
            $html = $OUTPUT->render($button);
        }
        return $html;
    }
    
    /**
     * Returns the HTML for a button that navigates to the course. The button text reflects the user's completion progress.
     * 
     * @param unknown $course
     * @param unknown $completion_data
     * @return string
     */
    public function get_course_link($course, $completion_data) {
        global $CFG, $OUTPUT; 
        
        $html = '';
        
        $url = new moodle_url($CFG->wwwroot.'/course/view.php', array('id'=>$course->id));
        
        $progress = intval($completion_data->percentage);
        
        if ($progress == 100) {
            $buttonString = get_string('retakecourse', 'block_courses_available');
        } elseif ($progress == 0) {
            $buttonString = get_string('startcourse', 'block_courses_available');
        } else {
            $buttonString = get_string('continuecourse', 'block_courses_available');
        }
        $button = new single_button($url, $buttonString, 'get');
        $button->class = 'tablebutton';
        
        $html = $OUTPUT->render($button);
        
        return $html;
    }
}
