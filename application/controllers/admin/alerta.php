<?php

class Alerta extends CI_Controller {
	
	function lista() {
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		 
		// get current user id
		$id = $this->auth->userid();
		 
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);


		$this->load->helper(array('form'));
		 
		$this->load->model ( "alertas");
		$lista = $this->alertas->ListaAlertaPerfil ();
		 
		 
		$data = array(
				'ativo' => 'alertas',
				'lista' => $lista,
				'user' => $user
		);
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/alerta_lista', $data);
		$this->load->view('admin/templates/footer', $data);
	}
	function carrega() {
		$this->load->helper('url');
		redirect('admin/alerta/carga');
		redirect('admin/logs/view');
	}
	function carga() {
		
		log_message('INFO', 'Iniciando carga de alertas');
		
		ini_set('memory_limit', '-1');
		ini_set('max_input_time', '3600');
		setlocale (LC_ALL, 'pt_BR');
		
		
		$this->load->model ( "alertas");
		$this->load->model ( "anuncio_imovel");
		$this->load->model ( "alerta_imovel");
		$this->load->model ( "anuncio_auto");
		$this->load->model ( "alerta_auto");
		$this->load->model ( "anuncio_emprego");
		$this->load->model ( "alerta_emprego");
		$this->load->model ( "anuncio_produto");
		$this->load->model ( "alerta_produto");
		$this->load->model ( "anuncio_temporada");
		$this->load->model ( "alerta_temporada");
		$lista = $this->alertas->ListaTodosCarga ();
		
		foreach ($lista as $row) {
			switch ($row->apr-id) {
				case 1: {
					$param = array(
							'%' . $row->alr_pesquisa . '%',
							$row->pct_id,
							$row->pt_id,
							$row->cd_id,
							$row->es_id,
							$row->ali_preco_in,
							$row->ali_preco_out,
							$row->ali_quartos,
							TRUE
					);
					$pesquisa = $this->anuncio_imovel->AnuncioPesquisa ($param);
					$param[count($param)-1] = FALSE;
					$pesquisa_destaque = $this->alerta_imovel->AnuncioPesquisa ($param);
					$data = array(
							'alerta' => $row,
							'anuncio' => $pesquisa,
							'anuncio_destaque' => $pesquisa_destaque
					);
					$html = $this->load->view('admin/alerta_imovel_html', $data, TRUE);
					$this->sendmail($html, $row->email, 'Seu alerta por email');
					
					break;
				}
				case 2: {
					$param = array(
							'%' . $row->alr_pesquisa . '%',
							$row->crt_id,
							$row->cmr_id,
							$row->cmd_id,
							$row->es_id,
							$row->cd_id,
							$row->ala_preco_in,
							$row->ala_preco_out,
							$row->ala_novo,
							TRUE
					);
					$pesquisa = $this->anuncio_auto->AnuncioPesquisa ($param);
					$param[count($param)-1] = FALSE;
					$pesquisa_destaque = $this->alerta_auto->AnuncioPesquisa ($param);
					$data = array(
							'alerta' => $row,
							'anuncio' => $pesquisa,
							'anuncio_destaque' => $pesquisa_destaque
					);
					$html = $this->load->view('admin/alerta_auto_html', $data, TRUE);
					$this->sendmail($html, $row->email, 'Seu alerta por email');
						
					break;
				}
				case 3: {
					$param = array(
							'%' . $row->alr_pesquisa . '%',
							$row->ect_id,
							$row->pt_id,
							$row->emc_id,
							$row->emp_id,
							$row->ps_id,
							$row->es_id,
							$row->cd_id,
							TRUE
					);
					$pesquisa = $this->anuncio_emprego->AnuncioPesquisa ($param);
					$param[count($param)-1] = FALSE;
					$pesquisa_destaque = $this->alerta_emprego->AnuncioPesquisa ($param);
					$data = array(
							'alerta' => $row,
							'anuncio' => $pesquisa,
							'anuncio_destaque' => $pesquisa_destaque
					);
					$html = $this->load->view('admin/alerta_emprego_html', $data, TRUE);
					$this->sendmail($html, $row->email, 'Seu alerta por email');
						
					break;
				}
				case 4: {
					$param = array(
							'%' . $row->alr_pesquisa . '%',
							$row->prc_id,
							$row->pmr_id,
							$row->pmd_id,
							$row->es_id,
							$row->cd_id,
							TRUE
					);
					$pesquisa = $this->anuncio_produto->AnuncioPesquisa ($param);
					$param[count($param)-1] = FALSE;
					$pesquisa_destaque = $this->alerta_produto->AnuncioPesquisa ($param);
					$data = array(
							'alerta' => $row,
							'anuncio' => $pesquisa,
							'anuncio_destaque' => $pesquisa_destaque
					);
					$html = $this->load->view('admin/alerta_produto_html', $data, TRUE);
					$this->sendmail($html, $row->email, 'Seu alerta por email');
						
					break;
				}
				case 5: {
					$param = array(
							'%' . $row->alr_pesquisa . '%',
							$row->pt_id,
							$row->ps_id,
							$row->es_id,
							$row->cd_id,
							TRUE
					);
					$pesquisa = $this->anuncio_temporada->AnuncioPesquisa ($param);
					$param[count($param)-1] = FALSE;
					$pesquisa_destaque = $this->alerta_temporada->AnuncioPesquisa ($param);
					$data = array(
							'alerta' => $row,
							'anuncio' => $pesquisa,
							'anuncio_destaque' => $pesquisa_destaque
					);
					$html = $this->load->view('admin/alerta_produto_html', $data, TRUE);
					$this->sendmail($html, $row->email, 'Seu alerta por email');
						
					break;
				}
			}

			$this->alertas->SetaDataUltimaAlteracao($row->alr_id);			
		}
		
		
	}
	
	function sendmail($html, $email, $subject) {
		$this->load->library('email');
			
		$this->email->from('contato@querocarros.com', 'motorbusca.com.br.com');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($html);
			
		if (!$this->email->send()) {
			log_message('ERROR', $this->email->print_debugger());
		} else {
			log_message('INFO', "envou email para " . $email);
		}
	}
}