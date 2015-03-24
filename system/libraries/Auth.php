<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Auth
    {
            private $ci;   
            public function __construct(){
            $this->ci = &get_instance();       
        }

        function check_logged($classe,$metodo)
        {
            /*
            * Criando uma instância do CodeIgniter para poder acessar
            * banco de dados, sessionns, models, etc...
            */
            $this->CI =& get_instance();

            /**
            * Buscando a classe e metodo da tabela tbl_metodos
            */
            $array = array('classe' => $classe, 'metodo' => $metodo);
            $this->CI->db->where($array);
            $query = $this->CI->db->get('tbl_metodos');       
            $result = $query->result();

        // Se este metodo ainda não existir na tabela sera cadastrado
        if(count($result)==0){
            $data = array(
                'classe' => $classe ,
                'nome' => $classe ,
                'data_criacao' => $this->CI->site->getData() ,
                'metodo' => $metodo ,
                'descricao' => $metodo ,
                'apelido' => $classe .  '/' . $metodo,
                'privado' => 1
             );
            $this->CI->db->insert('tbl_metodos', $data);
            
            $this->CI->site->location("$classe/$metodo");
            //redirect($classe . '/' . $metodo);
        }
        //Se ja existir tras as informacoes de publico ou privado
        else{
            if($result[0]->privado==0){
                // Escapa da validacao e mostra o metodo.
                return false;
            }
            else{
                
                $this->CI->load->library('session');
                // Se for privado, verifica o login
                $nome = $this->CI->session->userdata('usuario');
                $logged_in = $this->CI->session->userdata('logged_in');
                $data = $this->CI->session->userdata('data');
                //$email = $this->ci->session->userdata('email');
                $id_usuario =  $this->CI->session->userdata('id_usuario');
                $perfil = $this->CI->session->userdata('perfil');
                $id_tbl_metodos = $result[0]->id;
                $registro = $this->CI->session->userdata('registro');
                $limite = $this->CI->session->userdata('limite');
                
                // Se o usuario estiver logado vai verificar se tem permissao na tabela.
                if($nome && $logged_in && $id_usuario){
                    
                    if($registro){
                        $segundos = time() - $registro;
                    }

                    if($segundos > $limite){
                        
                        $this->ci->session->sess_destroy();
                        $this->ci->site->location('login?erro=timeout');
                        exit();
                    }

                    else{
                        $login = array('registro' => time());
                        $this->ci->session->set_userdata($login);
                    }
                    
                    $array = array('id_metodo' => $id_tbl_metodos, 'id_perfil' => $perfil);
                    $this->CI->db->where($array);
                    $query2 = $this->CI->db->get('tbl_permissoes');       
                    $result2 = $query2->result();

                    // Se não vier nenhum resultado da consulta, manda para página de
                    // usuario sem permissão.
                    if(count($result2)==0){
                        
                        return false; 
                    }
                    else{
                        return true;
                    }                       
                    }
                    // Se não estiver logado, sera redirecionado para o login.
                    else{
                         $this->CI->site->location('login');
                    }
                }
                }   
            }

    /**
    * Método auxiliar para autenticar entradas em menu.
    * Não faz parte do plugin como um todo.
    */
            function check_menu($classe,$metodo){
                $this->CI =& get_instance();
             $sql = "SELECT SQL_CACHE
                count(tbl_permissoes.id) as found
                FROM
                tbl_permissoes
                INNER JOIN tbl_metodos
                ON tbl_metodos.id = tbl_permissoes.id_metodo
                WHERE id_usuario = '" . $this->ci->session->userdata('id_usuario') . "'
                AND classe = '" . $classe . "'
                AND metodo = '" . $metodo . "'";
            $query = $this->CI->db->query($sql);       
            $result = $query->result();
            return $result[0]->found;
            }
    }