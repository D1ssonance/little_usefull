<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This helper uses functions from url and text helpers,
 * so you need to enable them in config/autoload.php
 * minimum config to use helper:
 * $autoload['helper'] = array('url', 'text', 'uniqueurl');
 * To change separator (default is '-' like in 'default-separator-url-671')
 * in row 19 change '-' to '_' to use underscore.
 * @param string $addr - string you need to use in url
 * @param string $table - table where could be stored this url and where could be the same urls
 * @param string $column - name of column in $table with url
 * @return string $addr - transliterated, converted to usable in url string
 * with additional counter if function found same string in database.
 */
if ( ! function_exists('makeUniqueURL')) {
    function makeUniqueURL(string $addr, string $table, string $column)
    {
        $addr = url_title(convert_accented_characters($addr), '-', true);
        $post = new CI_Model();
        $query = $post->db->get_where($table, [$column => $addr]);
        $isUnique = $query->row_array();

        if (!is_null($isUnique)) {
            $post->db->like($column, $addr, 'after');
            $query = $post->db->get($table);
            $isUnique = $query->result_array();
            $lastNums = [];
            foreach ($isUnique as $row) {
                preg_match('/(?<=-)[0-9]+$/', $row[$column], $result);
                if (!empty($result)) {
                    $lastNums[] = $result[0];
                }
            }
            $postfix = 1;
            if (!empty($lastNums)) {
                $postfix = max($lastNums) + 1;
            }
            return $addr . '-' . $postfix;
        }
        return $addr;
    }
}