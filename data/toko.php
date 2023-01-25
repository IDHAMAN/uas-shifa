<?php
class toko
{
    public $id;
    public $nama_buku;
    public $penulis;
     public $harga;

    private $conn;
    private $table = "tbl_buku";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
               id=:id, nama_buku=:name_buku, penulis=:penulis, harga=:harga";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('nama_buku', $this->nama_buku);
        $stmt->bindParam('penulis', $this->penulis);
        $stmt->bindParam('harga', $this->harga);

        //if ($stmt->execute()) {
            return true;
        //}
        return false;

        
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($ $query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function fetch()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get()
    {
        $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.id = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $toko = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $toko['id'];
        $this->nama_buku = $toko['nama_buku'];
        $this->penulis = $toko['penulis'];
        $this->harga = $toko['harga'];
    }

    function update()
    {
     $query = "UPDATE
                " . $this->table . "
            SET
                nama_buku = :nama_buku,
                penulis = :penulis,
                harga = :harga
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('nama_buku', $this->nama_buku);
        $stmt->bindParam('penulis', $this->penulis);
        $stmt->bindParam('harga', $this->harga);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}