<?php

 $config = array(

     
     'valida_add_tonner' => array(
         
      'id_tonner'        => array('field' => 'id_tonner', 'label' => 'Tonner',  'rules' => 'required')   
     ),
     
     'valida_add_saldo' => array(
         
      'credito'        => array('field' => 'credito', 'label' => 'Crédito',  'rules' => 'required|integer'),
      'id_tonner_fornecedor'        => array('field' => 'id_tonner_fornecedor', 'label' => 'Fornecedor',  'rules' => 'required|integer'),
      'id_ordem_compra'        => array('field' => 'id_ordem_compra', 'label' => 'Ordem de Compra',  'rules' => 'required')
     ),
     
     'valida_add_impressora' => array(
         
      'id_impressora'        => array('field' => 'id_impressora', 'label' => 'Impressora',  'rules' => 'required')   
     ),
     
     'valida_perfil' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_editar_status' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'css'        => array('field' => 'css', 'label' => 'Classe CSS',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     
     'valida_metodo' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'descricao'       => array('field' => 'descricao','label' => 'Descrição','rules' => 'required')   
     ),
     
     'valida_fornecedor' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'telefone'        => array('field' => 'telefone', 'label' => 'Telefone',  'rules' => 'required'),
      'endereco'        => array('field' => 'endereco', 'label' => 'Endereço',  'rules' => ''),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_solicitacoes' => array(
         
      'id departamento'        => array('field' => 'id_departamento', 'label' => 'Departamento',  'rules' => 'required'),
      'id_tonner'        => array('field' => 'id_tonner', 'label' => 'Tonner',  'rules' => 'required'),
      'quantidade'        => array('field' => 'quantidade', 'label' => 'Quantidade',  'rules' => 'required|integer'),
      'responsavel_entrega'        => array('field' => 'responsavel_entrega', 'label' => 'Responsável',  'rules' => 'required'),
      'email'        => array('field' => 'email', 'label' => 'E-mail',  'rules' => 'required|valid_email'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_solicitacoes_editar' => array(
         
      'responsavel_devolucao'        => array('field' => 'responsavel_devolucao', 'label' => 'Responsável',  'rules' => 'required'),
      'data_devolucao'        => array('field' => 'data_devolucao', 'label' => 'Data de Devolução',  'rules' => 'required'),
      'email'        => array('field' => 'email', 'label' => 'E-mail',  'rules' => 'required|valid_email'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_tipo' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_impressora' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'modelo'        => array('field' => 'modelo', 'label' => 'Modelo',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_departamento' => array(
         
      'nome'           => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'telefone'           => array('field' => 'telefone', 'label' => 'Telefone',  'rules' => 'required'),
      'tipo'           => array('field' => 'tipo', 'label' => 'Tipo',  'rules' => 'required'),
      'status'          => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
      'valida_disciplina' => array(
         
      'nome'            => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'carga_horaria'   => array('field' => 'carga_horaria', 'label' => 'Carga Horária',  'rules' => 'required|numeric'),
      'status'          => array('field' => 'status','label' => 'Status','rules' => 'required')   
     
      ),
     
     'valida_usuario' => array(
         
      'cpf'        => array('field' => 'cpf', 'label' => 'CPF',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required'),
      'perfil'        => array('field' => 'id_perfil', 'label' => 'Perfil',  'rules' => 'required'),
      'id_moodle'        => array('field' => 'id_moodle', 'label' => 'Usuário Moodle',  'rules' => 'required')
     
      ),
     
     'valida_usuario_editar' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'cpf'        => array('field' => 'cpf', 'label' => 'CPF',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required'),
      'email'        => array('field' => 'email', 'label' => 'E-mail',  'rules' => 'required|valid_email'),
      'perfil'        => array('field' => 'id_perfil', 'label' => 'Perfil',  'rules' => 'required'),
      'usuario'        => array('field' => 'usuario', 'label' => 'Usuário',  'rules' => 'required|alpha_numeric|min_length[4]')
     
      ),
     
     'valida_usuario_senha' => array(
         
      'id'        => array('field' => 'id', 'label' => 'ID',  'rules' => 'required'),
      'senha'        => array('field' => 'senha', 'label' => 'Senha',  'rules' => 'required|min_length[6]')
     
      ),
     
     'valida_item_menu' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required'),
      
      'id_metodo'       => array('field' => 'id_metodo','label' => 'Destino','rules' => 'required'),   
      'id_menu'       => array('field' => 'id_menu','label' => 'Menu','rules' => 'required'),
         ),
     
     'valida_polo' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'cidade'        => array('field' => 'cidade', 'label' => 'Cidade',  'rules' => 'required'),
      'email'        => array('field' => 'email', 'label' => 'E-mail',  'rules' => 'valid_email'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_noticia' => array(
         
      'titulo'        => array('field' => 'titulo', 'label' => 'Título',  'rules' => 'required'),
      'texto'        => array('field' => 'texto', 'label' => 'Texto',  'rules' => 'required'),
      'pre_texto'        => array('field' => 'pre_texto', 'label' => 'Pré Texto',  'rules' => ''),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_curso' => array(
         
      'nome'        => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'tipo'        => array('field' => 'tipo', 'label' => 'Tipo de Curso',  'rules' => 'required'),
      'form_inscricao'        => array('field' => 'form_inscricao', 'label' => 'Inscrição',  'rules' => 'required'),
      'pagamento'        => array('field' => 'pagamento', 'label' => 'Pagamento',  'rules' => 'required'),
      'descricao'        => array('field' => 'descricao', 'label' => 'Descrição',  'rules' => 'required'),
      'data_inicio'        => array('field' => 'data_inicio', 'label' => 'Data de Início',  'rules' => 'required'),
      'data_fim'        => array('field' => 'data_fim', 'label' => 'Data de Fim',  'rules' => 'required'),
      'status'       => array('field' => 'status','label' => 'Status','rules' => 'required')   
     ),
     
     'valida_destaque' => array(
     
      'titulo'                  => array('field' => 'titulo', 'label' => 'Título',  'rules' => 'required|max_length[50]'),
      'texto'                   => array('field' => 'texto','label' => 'Texto','rules' => 'required'),
      'pre_texto'               => array('field' => 'pre_texto','label' => 'Pré-Texto','rules' => 'required|max_length[250]'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_processo_seletivo' => array(
     
      'nome'                  => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'tipo'                   => array('field' => 'tipo','label' => 'Tipo','rules' => 'required'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_arquivo' => array(
     
      'nome'                  => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'idprocesso'                   => array('field' => 'idprocesso','label' => 'Processo','rules' => 'required'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_banner' => array(
     
      'titulo'                  => array('field' => 'titulo', 'label' => 'Titulo',  'rules' => 'required'),
      'data_inicio'                   => array('field' => 'data_inicio','label' => 'Data de Início','rules' => 'required'),
      'data_fim'                   => array('field' => 'data_fim','label' => 'Data de Término','rules' => 'required'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_institucional' => array(
     
      'texto'                  => array('field' => 'texto', 'label' => 'Texto',  'rules' => 'required'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_video' => array(
     
      'nome'                  => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'link'                  => array('field' => 'link', 'label' => 'Link',  'rules' => 'required'),
      'status'                  => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_downloads' => array(
     
      'nome'                  => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'categoria'             => array('field' => 'categoria', 'label' => 'Categoria',  'rules' => 'required'),
      'status'                => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     'valida_contato' => array(
     
      'nome'                  => array('field' => 'nome', 'label' => 'Nome',  'rules' => 'required'),
      'tipo'             => array('field' => 'tipo', 'label' => 'Tipo',  'rules' => 'required'),
      'status'                => array('field' => 'status','label' => 'Status','rules' => 'required')),
     
     
     'valida_contato_config' => array(
     
      'contato'                  => array('field' => 'contato', 'label' => 'contato',  'rules' => 'required'),
      'status'                => array('field' => 'status','label' => 'Status','rules' => 'required'))
     
     
    );
    
?>
