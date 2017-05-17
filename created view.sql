 Created view
			// relis_view_paper_processed
			 SELECT DISTINCT(P.id) as Pid , P.* FROM  	relis_paper P INNER JOIN  relis_classification C ON (P.id = C.class_paper_id) WHERE paper_active=1 AND class_active=1

			//relis_view_paper_pending
			SELECT * FROM  	relis_paper WHERE id NOT IN(  SELECT DISTINCT(P.id) as id FROM relis_paper P INNER JOIN  relis_classification C ON (P.id = C.class_paper_id) WHERE paper_active=1 AND class_active=1 ) AND paper_active=1
			
			
			//relis_view_paper_assigned
			
			SELECT DISTINCT(P.id) as Pid , P.*, A.assigned_user_id 	 FROM  	relis_paper P INNER JOIN  relis_assigned A ON (P.id = A.assigned_paper_id) WHERE assigned_active=1 AND assigned_active=1


