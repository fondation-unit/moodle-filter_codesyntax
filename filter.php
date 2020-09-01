<?php

class filter_codesyntax extends moodle_text_filter {
    /**
     * Includes the AMD script if we find "content-prog" class occurrences.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = array()) {
        $search = "((content-prog [a-z0-9 -]+))is";
        $result = preg_replace_callback($search, array($this, 'filter_content_prog_callback'), $text);
        return $result;
    }

    private function filter_content_prog_callback($matches) {
        global $PAGE;

        if (!empty($matches[1])) {
            $PAGE->requires->js_call_amd('filter_codesyntax/prism', 'init');
        }
    }
}
