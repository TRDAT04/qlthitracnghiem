<?php
class LienHe extends Controller
{
    function Get_data()
    {

        $this->view('Masterlayout', [
            'page' => 'LienHe'
        ]);
    }

    function HS()
    {
        $this->view('Masterlayout_student', [
            'page' => 'LienHe_HS'
        ]);
    }
}
