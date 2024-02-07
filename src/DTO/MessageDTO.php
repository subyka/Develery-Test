<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class MessageDTO
{

    private ?int $id = null;
    
    private ?string $name;

    private ?string $email;

    private ?string $message;

    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setId($id){

        $this->id = $id;

        return $this;
    }

    public function getName(): ?string{
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name){

        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string{
        return $this->email;
    }

    /**
    * Set the value of email
    *
    * @return  self
    */ 
    public function setEmail(?string $email){

        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string{
        return $this->message;
    }

    /**
    * Set the value of message
    *
    * @return  self
    */ 
    public function setMessage(?string $message){

        $this->message = $message;

        return $this;
    }

       
}
