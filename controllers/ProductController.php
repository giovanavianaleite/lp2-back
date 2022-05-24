<?php
class ProductController{

    function create(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        //Entradas
        $titulo = $_POST['titulo'];
        $ano = $_POST['ano'];
        $foto = $_POST['foto'];
        $descricao = $_POST['descricao'];
        $saber = $_POST['saber'];
        $informacao = $_POST['informacao'];
        

        //Processamento ou Persistencia
        $product = new Product(null, $foto, $titulo, $ano);
        $id = $product->create();
        //Saída
        $result['message'] = "Produto Cadastrado com sucesso!";
        $result['product']['id'] = $id;
        $result['product']['titulo'] = $titulo;
        $result['product']['ano'] = $ano;
        $result['product']['foto'] = $foto;
        $result['product']['descricao'] = $descricao;
        $result['product']['saber'] = $saber;
        $result['product']['informacao'] = $informacao;
        $response->out($result);
    }

    function delete(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $product = new Product($id, null, null, null, null, null, null);
        $user->delete();
        $result['message'] = "User deletado com sucesso!";
        $result['product']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $ano = $_POST['ano'];
        $foto = $_POST['foto'];
        $descricao = $_POST['descricao'];
        $saber = $_POST['saber'];
        $informacao = $_POST['informacao'];
        $product = new Product($id, $titulo, $ano, $foto, $descricao, $saber, $informacao);
        $user->update();
        $result['message'] = "Produto atualizado com sucesso!";
        $result['product']['id'] = $id;
        $result['product']['titulo'] = $titulo;
        $result['product']['ano'] = $ano;
        $result['product']['foto'] = $foto;
        $result['product']['descricao'] = $descricao;
        $result['product']['saber'] = $saber;
        $result['product']['informacao'] = $informacao;
        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');
        $product = new Product(null, null, null, null, null, null, null);
        $result = $user->selectAll();
        $response->out($result);
    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $product = new Product($id, null, null, null, null, null, null);
        $result = $product->selectById();
        $response->out($result);
    }

}
?>