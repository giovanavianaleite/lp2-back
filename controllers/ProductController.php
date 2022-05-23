<?php
class ProductController{

    function create(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        //Entradas
        $title = $_POST['title'];
        $year = $_POST['year'];
        $photo = $_POST['photo'];
        $photo = $_POST['description'];
        $photo = $_POST['know'];
        $photo = $_POST['information'];
        

        //Processamento ou Persistencia
        $product = new Product(null, $photo, $title, $year);
        $id = $product->create();
        //Saída
        $result['message'] = "Produto Cadastrado com sucesso!";
        $result['product']['id'] = $id;
        $result['product']['title'] = $title;
        $result['product']['year'] = $year;
        $result['product']['photo'] = $photo;
        $result['product']['description'] = $description;
        $result['product']['know'] = $know;
        $result['product']['information'] = $information;
        $response->out($result);
    }

    function delete(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $user = new User($id, null, null, null);
        $user->delete();
        $result['message'] = "User deletado com sucesso!";
        $result['user']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response = new Output();
        $response->allowedMethod('POST');

        $auth = new Auth();
        $user_session = $auth->allowedRole('admin');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $user = new User($id, $name, $email, $pass);
        $user->update();
        $result['message'] = "User atualizado com sucesso!";
        $result['user']['id'] = $id;
        $result['user']['name'] = $name;
        $result['user']['email'] = $email;
        $response->out($result);
    }

    function selectAll(){
        $response = new Output();
        $response->allowedMethod('GET');
        $user = new User(null, null, null, null);
        $result = $user->selectAll();
        $response->out($result);
    }

    function selectById(){
        $response = new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $user = new User($id, null, null, null);
        $result = $user->selectById();
        $response->out($result);
    }

}
?>