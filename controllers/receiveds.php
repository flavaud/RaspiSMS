<?php
	/**
	 * Page des SMS reçus
	 */
	class receiveds extends Controller
	{
		/**
		 * Cette fonction est appelée avant toute les autres : 
		 * Elle vérifie que l'utilisateur est bien connecté
		 * @return void;
		 */
		public function before()
		{
			internalTools::verifyConnect();
		}

		/**
		 * Cette fonction est alias de showAll()
		 */	
		public function byDefault()
		{
			$this->showAll();
		}
		
		/**
		 * Cette fonction retourne tous les SMS envoyés, sous forme d'un tableau
		 * @return void;
		 */
		public function showAll()
		{
			//Creation de l'object de base de données
			global $db;
			
			
			$page = (int)(isset($_GET['page']) ? $_GET['page'] : 0);
			$limit = 25;
			$offset = $limit * $page;
			

			//Récupération des SMS envoyés triés par date, du plus récent au plus ancien, par paquets de $limit, en ignorant les $offset premiers
			$receiveds = $db->getAll('receiveds', 'at', true, $limit, $offset);

			$this->render('receiveds', array(
				'receiveds' => $receiveds,
				'page' => $page,
				'limit' => $limit,
				'nbResults' => count($receiveds),
			));
		}
	}
