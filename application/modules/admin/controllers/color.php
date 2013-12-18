<?php
class Color extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( 'm_color' );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'category/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_color ()
    {
        if ( $this->check_role )
        {
            $temp['data']['list_color'] = $this->m_color->get_all_color ();
            $temp['title'] = "Color";
            $temp['template'] = 'color/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function edit ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]['color'] = $this->m_color->get_color_by_id ( $id );
            $temp['title'] = "Color";
            $temp['template'] = 'color/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "Color";
            $temp['template'] = 'color/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $color = new DTO_color();
                $color->setName ( $_POST['color_name'] );
                if ( isset ( $_POST['color_id'] ) )
                {
                    if ( $this->m_color->update_color ( $color, $_POST['color_id'] ) )
                    {
                        //success
                    }
                    else
                    {
                        //error
                    }
                }
                else
                {
                    if ( $this->m_color->insert_color ( $color ) )
                    {
                        //success
                    }
                    else
                    {
                        //error
                    }
                }
            }
            redirect ( 'admin/color/list_color' );
        }
    }

    public function delete ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            if ( $this->m_color->delete_color ( $id ) )
            {
                //success
                //$this->session->set_flashdata ( 'result', 'Delete Sucess!' );
            }
            else
            {
                //fail
                //$this->session->set_flashdata ( 'result', 'Delete Fail!' );
            }
            redirect ( 'admin/color/list_color' );
        }
    }

    protected function check ()
    {
        if ( $this->session->userdata ( "user_role" ) && $this->session->userdata ( "user_infor" ) )
        {
            $result = FALSE;
            foreach ( $this->session->userdata ( "user_role" ) as $roles )
            {
                if ( in_array ( 'admin', $roles ) OR in_array ( 'color', $roles ) )
                {
                    $result = TRUE;
                }
            }

            return $result;
        }
    }

}
