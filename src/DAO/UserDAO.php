<?php
namespace App\src\DAO;

use Config\Alexis\Parameter;
use App\src\model\User;
class UserDAO extends DAO{
    private function buildObject($row){
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setDateCreated($row['dateCreated']);
        $user->setRole($row['name']);
        return $user;
    }
    public function getUsers(){
       $sql = 'SELECT user.id, user.pseudo, user.dateCreated, role.role_name FROM user INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }
    public function register(Parameter $post){
        $sql = 'INSERT INTO user (name, email, password, role_id, dateCreated) VALUES(?, ?, ?, ?, NOW()) ';
        $this->createQuery($sql, [$post->get('name'), $post->get('email'), password_hash($post->get('password'), PASSWORD_DEFAULT), 2]);
    }
    public function checkEmail(Parameter $post){
        $sql = 'SELECT COUNT(email) FROM user WHERE email= ? ';
        $request = $this->createQuery($sql, [$post->get('email')]);
        $isUnique = $request->fetchColumn();
        if ($isUnique){
            return '<p class="center alert alert-warning">Le mail existe déja</p>';
        }
    }
    public function login(Parameter $post){
        $sql = 'SELECT user.id, user.role_id, user.password, user.name, role.role_name FROM user INNER JOIN role ON role.id = user.role_id WHERE user.email = ?';
        $data = $this->createQuery($sql, [$post->get('email')]);
        $request = $data->fetch();
        if ($request){
            $isPasswordValid = password_verify($post->get('password'), $request['password']);
            return [
                'result' => $request,
                'isPasswordValid' => $isPasswordValid
            ];
        }else{
            return [
                'result' => $request,
                'isPasswordValid' => false
            ];
        }
        return $request;
    }
    public function isPasswordValid($email, $password){
        $sql = 'SELECT password FROM user WHERE email = ?';
        $data = $this->createQuery($sql, [$email]);
        $request = $data->fetch();
        $isPasswordValid = password_verify($password, $request['password']);
        return $isPasswordValid;
    }
    public function isExistEmail($email){
        $sql = 'SELECT email FROM user WHERE email = ?';
        $data = $this->createQuery($sql, [$email]);
        $request = $data->fetch();
        if ($request != NULL){
            return false;
        }
        return true;

    }
    public function loginAuto($email, $password){
        $sql = 'SELECT user.id, user.role_id, user.password, role.role_name FROM user INNER JOIN role ON role.id = user.role_id WHERE user.email = ?';
        $data = $this->createQuery($sql, [$email]);
        $request = $data->fetch();
        if ($request['password'] == $password){
            return [
            'result' => $request,
            'isPasswordValid' => true
            ];
        }else{
            return [
                'result' => $request,
                'isPasswordValid' => false
            ];
        }
    }

    public function updatePassword(Parameter $post, $pseudo){
        $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [password_hash($post->get('password'), PASSWORD_DEFAULT), $pseudo]);
    }
   public function deleteAccount($userId){
       $sql = 'DELETE FROM user WHERE id = ?';
       $this->createQuery($sql, [$userId]);
   }
   public function modifyPassword($post, $id){
    $sql = "UPDATE user SET password = :password WHERE id = :id ";
    $this->createQuery($sql, [
        'password' => password_hash($post->get('newPassword'), PASSWORD_DEFAULT),
        'id' => $id
        ]);
    }
    public function modifyName($post, $id){
        $sql = "UPDATE user SET name = :name WHERE id = :id ";
        $this->createQuery($sql, [
            'name' => $post->get('name'),
            'id' => $id
        ]);
    }
    public function modifyEmail($post, $id){
        $sql = "UPDATE user SET email = :email WHERE id = :id ";
        $this->createQuery($sql, [
            'email' => $post->get('email'),
            'id' => $id
        ]);
    }
}

