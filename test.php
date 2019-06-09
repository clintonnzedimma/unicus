class User {
	protected  $name;
	protected  $comments;
	protected  $privilege;
	protected $loginStatus = false;
	protected $lastLoggedInAt = null;

  function __construct($name) {
  	$this->name = $name;
    $this->privilege = 1;
  }

 public function getComments() {
  	global $comments;
  	$this->comments = $comments;
  }

 public function isLoggedIn() { return $this->loginStatus;}
  function getLastLoggedInAt() {
  	return $this->lastLoggedInAt;
  }

  public function logIn() {
  	$this->loginStatus = true;
  	$this->lastLoggedInAt = time();

  }
 public function logOut() {
  	 $this->loginStatus = false;
  }

  public function getName() { 
  	return  $this->name;
  }

 public function setName($name) {
  	$this->name = $name;
  }

  public function canEdit(Comment $comment) {

  		//$this->getComments();
    
 	if ($this->name === $comment->getAuthor() && $this->privilege == 1 ) {
 		return  true;
 	} else if ($this->privilege == 2 && $this->name === $comment->getAuthor() ) {
              return true;
     } else if ($this->privilege == 3) {
          	return true ;
     } else {
             return  false;
      }
  }

 public function canDelete($comment) {

	  	if ($this->privilege > 1) {
			return true;
		} else {
			return false;
		}
  }
}



class Moderator extends User {
	function __construct($name) {
	  parent::__construct($name);
      	  $this->privilege = 2;
	}
}




class Admin extends Moderator {
	function __construct($name) {
	  parent::__construct($name);
        $this->privilege = 3;
	}
}

class Comment {


	protected $author;
	protected $message;
	protected $repliedTo;
	protected $createdAt;
	protected $id = 0;

  function __construct($author, $message, $repliedTo = null) {
  	//global $comments;
  	$this->author = $author;
  	$this->setMessage($message);
  	$this->repliedTo = $repliedTo;
  	$this->createdAt = time();

// 	array_push($comments, ['author'=>$author,'message'=>$message,'repliedTo'=>$repliedTo, 'createdAt'=> $this->createdAt]);	
  	//$this->comments = $comments;
  }
  
    public function __get($name) {


        return $this->$name;
    }  

  function getMessage() {
  	return $this->message;
  }
  function setMessage($message) {
  	$this->message = $message;
  }
  
  
  function getCreatedAt() { return $this->createdAt;}
  function getAuthor() {  return $this->author;}
  function getRepliedTo() { return $this->repliedTo;}
  
   public function __toString () {
  	if ($this->repliedTo == null) {
  		return $this->message." by ". $this->author;
  	} else {
  		return $this->message." by ". $this->author ."(replied to". $this->repliedTo.")";
  	}
  } 
}
