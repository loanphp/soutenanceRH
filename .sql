--
ALTER TABLE `conges`
  ADD CONSTRAINT `fk_gs_employe_id` FOREIGN KEY (`employe_id`) REFERENCES `gs_employes` (`id`);

--
-- Contraintes pour la table `dossiers_du_personnels`
--
ALTER TABLE `dossiers_du_personnels`
  ADD CONSTRAINT `fk_employe_id` FOREIGN KEY (`employe_id`) REFERENCES `gs_employes` (`id`);

--
-- Contraintes pour la table `evaluations_de_performances`
--
ALTER TABLE `evaluations_de_performances`
  ADD CONSTRAINT `fk_evaluation_de_performances_id` FOREIGN KEY (`employe_id`) REFERENCES `gs_employes` (`id`);

--
-- Contraintes pour la table `gs_employes`
--
ALTER TABLE `gs_employes`
  ADD CONSTRAINT `fk_dossier_personnel_id` FOREIGN KEY (`dossier_personnel_id`) REFERENCES `dossiers_du_personnels` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);