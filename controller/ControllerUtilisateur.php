<?php
	require_once File::build_path(['model', 'Utilisateur.php']);
	require_once File::build_path(['lib', 'Security.php']);

	/**
	 * Il faut ajouter deleted et update et error
	 */
	class ControllerUtilisateur extends Controller
	{

        // public static function commandes(){
        //     $TITLE = "Commandes";
        //     $controller = "achat";
        //     $page = "commandes";
        //     $commandes = ["Pas de commandes"];

        //     require File::build_path(["view", "view.php"]);
        // }

        public static function panier(){
            $TITLE = "Panier";
            $controller = "achat";
            $page = "panier";

            require File::build_path(["view", "view.php"]);
        }

        public static function readAll(){
        	$tab_u = Utilisateur::selectAll();
        	$TITLE = "Liste Utilisateur";
        	$page = "list";
        	$controller = "utilisateur";
        	require File::build_path(['view', 'view.php']);
        }

	    public static function read(){
            $TITLE = "Profil";
            $controller = "utilisateur";
	        $page = "detail";
	        $idprofil = $_GET['idUtilisateur'];
	        $profil = Utilisateur::select($idprofil);

	        require File::build_path(["view", "view.php"]);
        }

        public static function modifierprofil(){
        	$u = Utilisateur::select($_GET['idUtilisateur']);
        	if(isset($_SESSION['projet_user_connected']) && (Session::is_admin() ||  $_SESSION['projet_user_connected']->getAttr('idUtilisateur') == $u->getAttr("idUtilisateur"))){
	            $TITLE = "Modifier Profil";
	            $controller = "utilisateur";
	            $page = "inscription";
	            $data = [
	            	"prenom" => $u->getAttr('prenomUtilisateur'),
	            	"nom" => $u->getAttr('nomUtilisateur'),
	            	"mail" => $u->getAttr('mailUtilisateur')
	            ];
	            $create = false;
	            require File::build_path(["view", "view.php"]);
        	}else{
        		$erreur = "Erreur lors de la modification";
        		$TITLE = "Profil";
	            $controller = "utilisateur";
		        $page = "detail";
		        $profil = $u;

		        require File::build_path(["view", "view.php"]);
        	}
        }

        public static function updated(){
        	$post = true;
        	if($_POST['prenomUtilisateur'] == "" || $_POST['nomUtilisateur'] == "") $post = false;
        	$u = Utilisateur::select($_POST['idUtilisateur']);
        	if(isset($_SESSION['projet_user_connected']) && (Session::is_admin() ||  $_SESSION['projet_user_connected']->getAttr('idUtilisateur') == $u->getAttr("idUtilisateur")) ){
        		if($post){
	        		Utilisateur::update($_POST, ['action', 'controller']);

	        		$page = "updated";
	        		$controller = "utilisateur";
	        		$TITLE = "Succès";
	        		require File::build_path(["view", "view.php"]);
        		}else{
        			$erreur = "Veuillez remplir tous les champs";
        			$TITLE = "Modifier Profil";
		            $controller = "utilisateur";
		            $page = "inscription";
		            $data = [
		            	"prenom" => $_POST['prenomUtilisateur'],
		            	"nom" => $_POST['nomUtilisateur'],
		            	"mail" => $_POST['mailUtilisateur'],
		            	"id" => $_POST['idUtilisateur'],
		            	"role" => $_POST['role']
		            ];
		            $create = false;
		            require File::build_path(["view", "view.php"]);
        		}
        	}else{
        		$erreur = "Erreur lors de la modification";
        		$TITLE = "Profil";
	            $controller = "utilisateur";
		        $page = "detail";
		        $profil = $u;

		        require File::build_path(["view", "view.php"]);
        	}
        }

        public static function delete(){
        	$get = true;
        	if(!isset($_GET['idUtilisateur'])) $get = false;
        	$u = Utilisateur::select($_GET['idUtilisateur']);
        	if(isset($_SESSION['projet_user_connected']) && $get && (Session::is_admin() ||  $_SESSION['projet_user_connected']->getAttr('idUtilisateur') == $u->getAttr("idUtilisateur"))){
        		Utilisateur::delete($_GET['idUtilisateur']);
        		$page = "deleted";
        		$controller = "utilisateur";
        		$TITLE = "Succès";
        		require File::build_path(["view", "view.php"]);
        	}else{
        		$erreur = "Erreur lors de la suppression";
        		$TITLE = "Profil";
	            $controller = "utilisateur";
		        $page = "detail";
		        $profil = $u;

		        require File::build_path(["view", "view.php"]);
        	}
        }
		
		public static function inscription(){
            $TITLE = "Inscription";
            $controller = "utilisateur";
            $create = true;
			$page = "inscription";
			$data['nom'] = isset($data['nom']) ? $data['nom'] : "";
			$data['prenom'] = isset($data['prenom']) ? $data['prenom'] : "";
			$data['mail'] = isset($data['mail']) ? $data['mail'] : "";

			require File::build_path(["view", "view.php"]);
		}

		public static function connexion(){
            $TITLE = "Connexion";
            $controller = "utilisateur";
			$page = "connexion";
			$data['mail'] = isset($data['mail']) ? $data['mail'] : "";

			require File::build_path(["view", "view.php"]);
		}

		public static function inscrire(){
            $TITLE = "Inscription";
            $erreur = $nom = $prenom = $mail = "";
			if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['remdp'])){
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$mail = $_POST['mail'];
				$mdp = $_POST['mdp'];
				$remdp = $_POST['remdp'];
				if(!Utilisateur::exist($mail)){
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						if(strlen($mdp) >= 6){
							if($mdp == $remdp){
								$nonce = Security::getRandomHex(16);
								$facticeMail = "projetPHP-".explode("@", htmlspecialchars($mail))[0];
			

								Utilisateur::save(["nomUtilisateur" => $nom, "prenomUtilisateur" => $prenom, "mailUtilisateur" => $mail, "mdpUtilisateur" => password_hash($mdp, PASSWORD_BCRYPT), "nonce"=>$nonce]);

								self::sendMail($facticeMail, $nonce, $mail);

								
								$controller = "utilisateur";
								$page = "inscrire";
                                $TITLE = "Validation inscription";

                                require File::build_path(["view", "view.php"]);
								}else{
									$erreur = "Les mots de passe sont différents.";
								}
							}else{
								$erreur = "Le mot de passe doit contenir 6 caractères minimum.";
							}
						}else{
							$erreur = "Adresse mail invalide.";
						}
					}else{
						$erreur = "Mail déjà enregistré.";
					}
				}else{
					$erreur = "Veuillez remplir tous les champs.";
				}

				if($erreur != ""){
					$data['nom'] = $nom;
					$data['prenom'] = $prenom;
					$data['mail'] = $mail;
					self::formError("inscription", $erreur, $data);
				}
				
		}


		public static function connecte(){
            $TITLE = "Connexion";
            $erreur = $mail = "";
			
			if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
				
				$mail = $_POST['mail'];
				$mdp = $_POST['mdp'];
				
				$mdp_crypt = Utilisateur::getMdpByMail($mail);

				if(!empty($mdp_crypt)){
					if(password_verify($mdp, $mdp_crypt)){

								$user = Utilisateur::getUtilisateurByMail($mail);
								if($user->getAttr('nonce') == NULL){
									$_SESSION['projet_user_connected'] = $user;
									header("Location:index.php");
								}else{
									$facticeMail = "projetPHP-".explode('@', htmlspecialchars($mail))[0];

									$erreur = "Mail non validé <p>Veuillez le validé sur : <a href='http://yopmail.com?".htmlspecialchars($facticeMail)."'>http://yopmail.com?".htmlspecialchars($facticeMail)."</a></p>";

								}

								
						}else{
							$erreur = "Mail/Mot de passe inconnus.";
						}
					}else{
						$erreur = "Mail/Mot de passe inconnus.";
					}
				}else{
					$erreur = "Veuillez remplir tous les champs.";
				}

				if($erreur != ""){
					$data['mail'] = $mail;
					self::formError("connexion", $erreur, $data);
				}
		}


		public static function formError($current_page, $erreur, $data){
			$controller = "utilisateur";
			$page = $current_page;
			require File::build_path(['view', 'view.php']);
		} 

		public static function deconnexion(){
			if(isset($_SESSION['projet_user_connected'])){
            	$_SESSION['projet_user_connected']->disconnect();
            }
			header("Location:index.php");
		}

		public static function sendMail($facticeMail, $nonce, $mail){

			
			$serveur = "https://webinfo.iutmontp.univ-montp2.fr/~seguraa/Projet_PHP"; //"localhost/projet_php";


			$to      = $facticeMail."@yopmail.com";
     		$subject = 'Inscription Site Librairie';
		    $message = "<h2>Bienvenue sur le site Librairie.com<h2> <p>Valider mon mail : <a href='".$serveur."/?action=validation&controller=utilisateur&mail=".rawurlencode($mail)."&nonce=".$nonce."'/>".$serveur."/?action=validation&controller=utilisateur&mail=".htmlspecialchars($mail)."&nonce=".$nonce."</a></p>";
		     

		     $success = mail($to, $subject, $message);

		     if (!$success) {
				    $errorMessage = error_get_last()['message'];
				}
		}

		public static function validation(){
			if(self::validate()){
				self::connexion();
			}else{
				$erreur = "Vérification échouée";
				$TITLE = "Erreur";
            	$controller = "utilisateur";
				$page = "connexion";
				$data['mail'] = isset($data['mail']) ? $data['mail'] : "";

				require File::build_path(["view", "view.php"]);
			}
		}


		public static function validate(){
			if(isset($_GET)){
				if(Utilisateur::validate($_GET['mail'], $_GET['nonce'])){
		            Utilisateur::changeNonce($_GET['mail']);
		            return true;
	        	}
			}
	        return false;
    	}
	}
?>