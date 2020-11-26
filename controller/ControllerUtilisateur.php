<?php
	require_once File::build_path(['model', 'Utilisateur.php']);
	
	/**
	 * 
	 */
	class ControllerUtilisateur
	{

        public static function commandes(){
            $controller = "achat";
            $page = "commandes";
            $commandes = ["Pas de commandes"];

            require File::build_path(["view", "view.php"]);
        }

        public static function panier(){
            $controller = "achat";
            $page = "panier";
            $panier = ["Aucun article sélectionner"];

            require File::build_path(["view", "view.php"]);
        }

	    public static function profil(){
	        $controller = "profil";
	        $page = "profil";
	        $idprofil = $_GET['id'];
	        $profil = Utilisateur::select($idprofil);

	        require File::build_path(["view", "view.php"]);
        }

        public static function modifierprofil(){
            $controller = "profil";
            $page = "modifierprofil";

            require File::build_path(["view", "view.php"]);
        }
		
		public static function inscription(){
			$controller = "utilisateur";
			$page = "inscription";
			$data['nom'] = isset($data['nom']) ? $data['nom'] : "";
			$data['prenom'] = isset($data['prenom']) ? $data['prenom'] : "";
			$data['mail'] = isset($data['mail']) ? $data['mail'] : "";

			require File::build_path(["view", "view.php"]);
		}

		public static function connexion(){
			$controller = "utilisateur";
			$page = "connexion";
			$data['mail'] = isset($data['mail']) ? $data['mail'] : "";

			require File::build_path(["view", "view.php"]);
		}

		public static function inscrire(){
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
								Utilisateur::save(["nomUtilisateur" => $nom, "prenomUtilisateur" => $prenom, "mailUtilisateur" => $mail, "mdpUtilisateur" => password_hash($mdp, PASSWORD_BCRYPT)]);

								//self::sendMail($mail);

								$_SESSION['projet_user_connected'] = Utilisateur::getUtilisateurByMail($mail);
								$controller = "accueil";
								$page = "index";

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
			$erreur = $mail = "";
			
			if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
				
				$mail = $_POST['mail'];
				$mdp = $_POST['mdp'];
				
				$mdp_crypt = Utilisateur::getMdpByMail($mail);

				if(!empty($mdp_crypt)){
					if(password_verify($mdp, $mdp_crypt)){

								$_SESSION['projet_user_connected'] = Utilisateur::getUtilisateurByMail($mail);
								$controller = "accueil";
								$page = "index";

								require File::build_path(["view", "view.php"]);
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
			$_SESSION['projet_user_connected']->disconnect();
			$controller = 'accueil';
			$page = 'index';
			require File::build_path(['view', 'view.php']);
		}

		public static function sendMail($mail){
			$to      = $mail;
     		$subject = 'Inscription Site Librairie';
		     $message = 'Bienvenue sur le site Librairie.com';
		     $headers = 'From: noreply.librairie@gmail.com' . "\r\n" .
		     'Reply-To: webmaster@example.com' . "\r\n" .
		     'X-Mailer: PHP/' . phpversion();

		     $success = mail($to, $subject, $message, $headers, "-fnoreply.librairie@gmail.com");

		     if (!$success) {
				    $errorMessage = error_get_last()['message'];
				}
		}
	}
?>