<?php 
class Product{
    public $id;
    public $titulo;
    public $ano;
    public $foto;
    public $descricao;
    public $saber;
    public $informacao;
    function __construct($id, $titulo, $ano, $foto, $descricao, $saber, $informacao) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->foto = $foto;
        $this->descricao = $descricao;
        $this->saber = $saber;
        $this->informacao = $informacao;
    }
    function create(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("INSERT INTO products (foto, titulo, ano)
            VALUES (:foto, :titulo, :ano, :foto, :descricao, :saber, :informacao );");
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':ano', $this->ano);
            $stmt->bindParam(':foto', $this->foto);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':saber', $this->saber);
            $stmt->bindParam(':informacao', $this->informacao);
        
            $stmt->execute();
            $id = $db->conn->lastInsertId();
            return $id;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Products: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function delete(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("DELETE FROM products WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch(PDOException $e) {
            $result['message'] = "Error Delete Product: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function update(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("UPDATE products SET foto = :foto, titulo = :titulo, ano = :ano, descricao = :descricao, saber = :saber, informacao = :informacao WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':foto', $this->foto);
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':ano', $this->ano);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':saber', $this->saber);
            $stmt->bindParam(':informacao', $this->informacao);

            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            $result['message'] = "Error Update Product: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function selectAll(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM products;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All Products: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function selectById(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT * FROM products WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select product By Id: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
}
?>