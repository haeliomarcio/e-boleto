<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\History;
use Illuminate\Support\Str;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;


class BoletosController extends Controller
{

    protected $prefixName = 'boletos';

    public function enviarBoletos() {
        $params = request()->all();
        $listClients = Client::all();
        $path = base_path("public_html/files/". $params['competencia']);
        try {
            $diretorio = dir($path);
        } catch (Exception $e) {
            return response()->json(['message' => 'Não existe boletos configurados para essa competência.'], 500);
        }
        
        echo "Lista de Arquivos do Diretório '<strong>".$path."</strong>':<br />";
        $list_arquivos = [];

        
        while($arquivo = $diretorio->read()){
            if($arquivo !== '.' && $arquivo !== '..'){
                $dado = explode('-', $arquivo);
                $list_arquivos[Str::slug($dado[0], '_')] = [
                    'nome_slug' => Str::slug($dado[0], '_'),
                    'nome' => $dado[0],
                    'arquivo' => $arquivo,
                    'enviado' => false,
                ];
            }
        }

        $arquivo = rtrim($arquivo, '.pdf');
        $diretorio->close();
        
        ob_start();
        foreach($listClients as $item){
            //foreach($list_arquivos as $key => $a){
                $name_slug = Str::slug($item->name, '_');
                if(isset($list_arquivos[$name_slug]) && !empty($list_arquivos[$name_slug])) {
                    //if( === $a['nome_slug']){
                        $list_arquivos[$name_slug]['email'] = $item->email;
                        // $list_arquivos[$key]['enviado'] = $this->enviaArquivo($item->id, $item->name, $item->email, $a['arquivo']);
                        $status_envio = $this->enviaArquivo(
                            $item->id, 
                            $item->name, 
                            $item->email, 
                            $list_arquivos[$name_slug]['arquivo'], 
                            $params['competencia'], 
                            $params['mensagem']
                        );
                        History::updateOrCreate(
                            ['client_id' => $item->id, 'status' => $status_envio, 'competence' => $params['competencia']],
                            ['client_id' => $item->id, 'status' => $status_envio, 'competence' => $params['competencia']]
                        );
                    //}
                }
            //}
        }

    }

    public function enviaArquivo($id, $nome, $email, $arquivo, $competencia, $mensagem){
        // Instância do objeto PHPMailer
        $mail = new PHPMailer();
        // Configura para envio de e-mails usando SMTP
        $mail->isSMTP();
        // Servidor SMTP
        $mail->Host = 'mail.rialci.com.br';
        // Usar autenticação SMTP
        $mail->SMTPAuth = true;
        // Usuário da conta
        $mail->Username = 'assc@rialci.com.br';
        // Senha da conta
        $mail->Password = '14ri4967';
        /// Tipo de encriptação que será usado na conexão SMTP
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // Porta do servidor SMTP
        $mail->Port = 465;
        // Informa se vamos enviar mensagens usando HTML
        $mail->IsHTML(true);
        // Email do Remetente
        $mail->From = 'assc@rialci.com.br';
        // Nome do Remetente
        $mail->FromName = 'ASSC | Associação de Saúde dos Servidores Civis';
        // Endereço do e-mail do destinatário
        $mail->addAddress($email);
        // Assunto do e-mail
        $mail->Subject = 'Boleto - Plano de Saúde Hapvida | ASSC'; 
        // Mensagem que vai no corpo do e-mail
        // echo '<pre>'; print_r($arquivo); die;
        $mail->Body = '<h1>Mensagem enviada via Rialci Consultoria</h1>';
        $mail->Body .= "<br /><br />".$mensagem. "<br /><br />";
        $arquivo = str_replace(" ", "_", $arquivo);
        $mail->Body .= 'Link do Boleto:<br /> http://localhost:8000/boleto/?boleto='.$arquivo."&competencia=".$competencia;
        $mail->Body .= 'Link do Boleto:<br /> http://localhost:8000/boleto/?boleto='.$arquivo."&competencia=".$competencia;
        
        // Envia o e-mail e captura o sucesso ou erro
        sleep(2);
        if($mail->Send()):
            echo  $nome. " - ".$email." - Enviado<br />";
            return true;
        else:
            echo  $nome. " - ".$email." - Error ao Enviar<br />";
            return false;
        endif;
        
        return false;
    }

    public function boleto() {
        $params = request()->all();
        // echo '<pre>'; print_r($params); die;
        $boleto = str_replace("_", " ", $params['boleto']);
        return redirect('/files/'.$params['competencia'].'/'.$boleto);
    }
}

