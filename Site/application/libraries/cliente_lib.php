<?php

class Cliente_lib
{
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('usuarios_model');
        $this->ci->load->model('funcionarias_model');
        $this->ci->load->model('afiliados_model');
    }

    public function cadastrar()
    {
        $avatar = '#';
        if (!empty($_FILES['file']['name'])) {
            $imgName = md5(uniqid(time())) . '.jpg';
            while (file_exists('upload/' . $imgName)) {
                $imgName = md5(uniqid(time())) . '.jpg';
            }

            $fp = fopen('upload/' . $imgName, 'wb');
            fwrite($fp, file_get_contents($_FILES['file']['tmp_name']));
            fclose($fp);

            $avatar = $imgName;
        }

        $idafiliado = $this->ci->input->post('idafiliado');
        $nome = $this->ci->input->post('nome');
        $categorias = $this->ci->input->post('categoria');
        $apresentacao = $this->ci->input->post('apresentacao');
        $especialidades = $this->ci->input->post('especialidades');

        $razaosocial = $this->ci->input->post('razaosocial');
        $nomefantasia = $this->ci->input->post('nomefantasia');

        $endereco = $this->ci->input->post('endereco');
        $bairro = $this->ci->input->post('bairro');
        $cidade = $this->ci->input->post('cidade');
        $estado = $this->ci->input->post('estado');
        $email = $this->ci->input->post('email');
        $senha = $this->ci->input->post('senha');
        $latitude = $this->ci->input->post('latitude');
        $longitude = $this->ci->input->post('longitude');
        $telefone = $this->ci->input->post('telefone');
        $celular = $this->ci->input->post('celular');

        $segunda_feira = $this->ci->input->post('segunda_feira');
        $terca_feira = $this->ci->input->post('terca_feira');
        $quarta_feira = $this->ci->input->post('quarta_feira');
        $quinta_feira = $this->ci->input->post('quinta_feira');
        $sexta_feira = $this->ci->input->post('sexta_feira');
        $sabado = $this->ci->input->post('sabado');
        $domingo = $this->ci->input->post('domingo');

        $de_segunda_feira = $this->ci->input->post('de_segunda_feira');
        $de_terca_feira = $this->ci->input->post('de_terca_feira');
        $de_quarta_feira = $this->ci->input->post('de_quarta_feira');
        $de_quinta_feira = $this->ci->input->post('de_quinta_feira');
        $de_sexta_feira = $this->ci->input->post('de_sexta_feira');
        $de_sabado = $this->ci->input->post('de_sabado');
        $de_domingo = $this->ci->input->post('de_domingo');

        $ate_segunda_feira = $this->ci->input->post('ate_segunda_feira');
        $ate_terca_feira = $this->ci->input->post('ate_terca_feira');
        $ate_quarta_feira = $this->ci->input->post('ate_quarta_feira');
        $ate_quinta_feira = $this->ci->input->post('ate_quinta_feira');
        $ate_sexta_feira = $this->ci->input->post('ate_sexta_feira');
        $ate_sabado = $this->ci->input->post('ate_sabado');
        $ate_domingo = $this->ci->input->post('ate_domingo');

        $tipo = $this->ci->input->post('tipo');
        if ($tipo == 'PF') {
            $cpfcnpj = $this->ci->input->post('cpf');
        } else {
            $cpfcnpj = $this->ci->input->post('cnpj');
        }

        $dataNascimento = date('Y-m-d', strtotime($this->ci->input->post('dataNascimento')));

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!is_object($this->ci->usuarios_model->pegar_usuario(array('email' => $email))) &&
                !is_object($this->ci->funcionarias_model->pegar_funcionaria(array('email' => $email))) &&
                !is_object($this->ci->afiliados_model->pegar_afiliado(array('email' => $email)))
            ) {
                $id_funcionaria = $this->ci->funcionarias_model->inserir(
                    array(
                        'idafiliado' => $idafiliado,
                        'tipo' => $tipo,
                        'cpfcnpj' => $cpfcnpj,
                        'datanascimento' => $dataNascimento,
                        'razaosocial' => $razaosocial,
                        'nomefantasia' => $nomefantasia,
                        'premium' => 0,
                        'precadastro' => 0,
                        'email' => $email,
                        'senha' => md5($senha),
                        'data_inserido' => date('Y-m-d H:i:s')
                    )
                );
                if ($id_funcionaria) {
                    $this->ci->db->insert('anuncios', array(
                        'idfuncionaria' => $id_funcionaria,
                        'titulo' => $nome,
                        'avatar' => $avatar,
                        'telefone' => $telefone,
                        'celular' => $celular,
                        'pontuacao' => 0,
                        'avaliacoes' => 0,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'endereco' => $endereco,
                        'bairro' => $bairro,
                        'cidade' => $cidade,
                        'estado' => $estado,
                        'especialidades' => $especialidades,
                        'apresentacao' => $apresentacao,
                        'data_inserido' => date('Y-m-d H:i:s')
                    ));

                    $idanuncio = $this->ci->db->insert_id();

                    foreach ($categorias as $categoria) {
                        $this->ci->db->insert('anuncio_categorias',
                            array(
                                'idcategoria' => $categoria,
                                'idanuncio' => $idanuncio
                            )
                        );
                    }

                    if ($domingo) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 0,
                                'hora' => $de_domingo
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 0,
                                'hora' => $ate_domingo
                            )
                        );
                    }

                    if ($segunda_feira) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 1,
                                'hora' => $de_segunda_feira
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 1,
                                'hora' => $ate_segunda_feira
                            )
                        );
                    }

                    if ($terca_feira) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 2,
                                'hora' => $de_terca_feira
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 2,
                                'hora' => $ate_terca_feira
                            )
                        );
                    }

                    if ($quarta_feira) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 3,
                                'hora' => $de_quarta_feira
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 3,
                                'hora' => $ate_quarta_feira
                            )
                        );
                    }

                    if ($quinta_feira) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 4,
                                'hora' => $de_quinta_feira
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 4,
                                'hora' => $ate_quinta_feira
                            )
                        );
                    }

                    if ($sexta_feira) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 5,
                                'hora' => $de_sexta_feira
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 5,
                                'hora' => $ate_sexta_feira
                            )
                        );
                    }

                    if ($sabado) {
                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'DE',
                                'dia' => 6,
                                'hora' => $de_sabado
                            )
                        );

                        $this->ci->db->insert('anuncio_atendimento',
                            array(
                                'idanuncio' => $idanuncio,
                                'tipo' => 'ATE',
                                'dia' => 6,
                                'hora' => $ate_sabado
                            )
                        );
                    }

                    return true;
                }
            }
        }

        return false;
    }

    public function cadastrar_anuncio($id_funcionaria)
    {
        $avatar = '#';
        if (!empty($_FILES['file']['name'])) {
            $imgName = md5(uniqid(time())) . '.jpg';
            while (file_exists('upload/' . $imgName)) {
                $imgName = md5(uniqid(time())) . '.jpg';
            }

            $fp = fopen('upload/' . $imgName, 'wb');
            fwrite($fp, file_get_contents($_FILES['file']['tmp_name']));
            fclose($fp);

            $avatar = $imgName;
        }

        $nome = $this->ci->input->post('nome');
        $categorias = $this->ci->input->post('categoria');
        $apresentacao = $this->ci->input->post('apresentacao');
        $especialidades = $this->ci->input->post('especialidades');

        $endereco = $this->ci->input->post('rua');
        $bairro = $this->ci->input->post('bairro');
        $cidade = $this->ci->input->post('cidade');
        $estado = $this->ci->input->post('estado');
        $latitude = $this->ci->input->post('latitude');
        $longitude = $this->ci->input->post('longitude');
        $telefone = $this->ci->input->post('telefone');
        $celular = $this->ci->input->post('celular');

        $segunda_feira = $this->ci->input->post('segunda_feira');
        $terca_feira = $this->ci->input->post('terca_feira');
        $quarta_feira = $this->ci->input->post('quarta_feira');
        $quinta_feira = $this->ci->input->post('quinta_feira');
        $sexta_feira = $this->ci->input->post('sexta_feira');
        $sabado = $this->ci->input->post('sabado');
        $domingo = $this->ci->input->post('domingo');

        $de_segunda_feira = $this->ci->input->post('de_segunda_feira');
        $de_terca_feira = $this->ci->input->post('de_terca_feira');
        $de_quarta_feira = $this->ci->input->post('de_quarta_feira');
        $de_quinta_feira = $this->ci->input->post('de_quinta_feira');
        $de_sexta_feira = $this->ci->input->post('de_sexta_feira');
        $de_sabado = $this->ci->input->post('de_sabado');
        $de_domingo = $this->ci->input->post('de_domingo');

        $ate_segunda_feira = $this->ci->input->post('ate_segunda_feira');
        $ate_terca_feira = $this->ci->input->post('ate_terca_feira');
        $ate_quarta_feira = $this->ci->input->post('ate_quarta_feira');
        $ate_quinta_feira = $this->ci->input->post('ate_quinta_feira');
        $ate_sexta_feira = $this->ci->input->post('ate_sexta_feira');
        $ate_sabado = $this->ci->input->post('ate_sabado');
        $ate_domingo = $this->ci->input->post('ate_domingo');

        if ($id_funcionaria) {
            $this->ci->db->insert('anuncios', array(
                'idfuncionaria' => $id_funcionaria,
                'titulo' => $nome,
                'avatar' => $avatar,
                'telefone' => $telefone,
                'celular' => $celular,
                'pontuacao' => 0,
                'avaliacoes' => 0,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'endereco' => $endereco,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado,
                'especialidades' => $especialidades,
                'apresentacao' => $apresentacao,
                'data_inserido' => date('Y-m-d H:i:s')
            ));

            $idanuncio = $this->ci->db->insert_id();

            foreach ($categorias as $categoria) {
                $this->ci->db->insert('anuncio_categorias',
                    array(
                        'idcategoria' => $categoria,
                        'idanuncio' => $idanuncio
                    )
                );
            }

            if ($domingo) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 0,
                        'hora' => $de_domingo
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 0,
                        'hora' => $ate_domingo
                    )
                );
            }

            if ($segunda_feira) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 1,
                        'hora' => $de_segunda_feira
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 1,
                        'hora' => $ate_segunda_feira
                    )
                );
            }

            if ($terca_feira) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 2,
                        'hora' => $de_terca_feira
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 2,
                        'hora' => $ate_terca_feira
                    )
                );
            }

            if ($quarta_feira) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 3,
                        'hora' => $de_quarta_feira
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 3,
                        'hora' => $ate_quarta_feira
                    )
                );
            }

            if ($quinta_feira) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 4,
                        'hora' => $de_quinta_feira
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 4,
                        'hora' => $ate_quinta_feira
                    )
                );
            }

            if ($sexta_feira) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 5,
                        'hora' => $de_sexta_feira
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 5,
                        'hora' => $ate_sexta_feira
                    )
                );
            }

            if ($sabado) {
                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'DE',
                        'dia' => 6,
                        'hora' => $de_sabado
                    )
                );

                $this->ci->db->insert('anuncio_atendimento',
                    array(
                        'idanuncio' => $idanuncio,
                        'tipo' => 'ATE',
                        'dia' => 6,
                        'hora' => $ate_sabado
                    )
                );
            }
        }
    }
}
?>