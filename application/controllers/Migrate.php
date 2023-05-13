<?php class Migrate extends CI_Controller
{

        public function index()
        {
                $this->load->library('migration');

                
                
                $migration_okay = $this->migration->latest();
                if (!$migration_okay) {
                //show_error($this->migration->error_string());
                        echo $this->migration->error_string();
                } else {
                //echo 'Migrated to latest version';
                        echo 'Migrated to latest version successfully';
                        #$this->session->sess_destroy();
                }
        }

}