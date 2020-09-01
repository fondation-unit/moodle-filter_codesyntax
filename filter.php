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
        global $PAGE;

        $search = "((language-[a-z0-9 -]+))is";
        preg_match($search, $text, $matches, PREG_OFFSET_CAPTURE);
        if (!empty($matches[0])) {
            $PAGE->requires->js_call_amd('filter_codesyntax/prism', 'init');
        }
        return $text;
    }
}
