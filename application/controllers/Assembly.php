<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends Application {

    public function index() {
        // shows bot assembly page, dropdowns for sections of bots, and login username
        $this->data['headparts'] = $this->partshead();
        $this->data['bodyparts'] = $this->partsbody();
        $this->data['legparts'] = $this->partsleg();
        $this->data['content'] = $this->parser->parse('assembly', $this->data, true);
        $this->data['pagebody'] = 'assembly';
        $this->data['username'] = $this->session->userdata('username');
        $this->render();
    }

    // requests headparts data from Parts model
    private function partshead() {
        $this->load->model('Parts');

        $rows = array();
        foreach ($this->Parts->get_partszero() as $record) {
            $rows[] = (array) $record;
        }
        $this->data['collections'] = $rows;

        return $this->parser->parse('headparts', $this->data, true);
    }

    // requests bodyparts data from Parts model
    private function partsbody() {
        $this->load->model('Parts');

        $rows = array();
        foreach ($this->Parts->get_partsone() as $record) {
            $rows[] = (array) $record;
        }
        $this->data['collections'] = $rows;

        return $this->parser->parse('bodyparts', $this->data, true);
    }

    // requests legparts data from Parts model
    private function partsleg() {
        $this->load->model('Parts');

        $rows = array();
        foreach ($this->Parts->get_partstwo() as $record) {
            $rows[] = (array) $record;
        }
        $this->data['collections'] = $rows;

        return $this->parser->parse('legparts', $this->data, true);
    }

    // assembles robot parts if they match and displays an error message if they don't
    function assemble() {
        $head = $_POST["head"];
        $body = $_POST["body"];
        $legs = $_POST["legs"];
        if ($head[2] == $body[2] && $body[2] == $legs[2]) {
            $this->data['head'] = $head;
            $this->data['body'] = $body;
            $this->data['legs'] = $legs;
        } else
            echo "BEEP BOOP BEEP BOOP Those aren't the right parts!";

        $this->index();
    }

}

/* End of file Assembly.php */
/* Location: application/controllers/Assembly.php */