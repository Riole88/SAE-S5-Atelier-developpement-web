-- ===========================================
-- USERS
-- ===========================================
INSERT INTO users (id, email, password_hash, role) VALUES
                                                       ('453a3455-5f4a-4e3b-b18f-339a5322cf67', 'eloi@hotmail.fr', '$2y$12$1lnw1PyeggiOzlO2q49Ht.YsljsyDAoG01tLwxGFzU.mXymmeAuRK', 0),
                                                       ('39d2c4f8-e022-4778-8043-d57fb76066e7', 'tuline@hotmail.fr', '$2y$12$OuGfvNKN9Bcv4vZHnM00aO6B6l0X8qccQvkcGUwm14/YHIGGESgDu', 0),
                                                       ('725b85b8-d42f-40b2-a42a-74cbc4ad0b37', 'hugo@hotmail.fr', '$2y$12$vfz5XU9.4DMhI0dZa6ujIOvCZ1Pf7ipmm0JQ776/hmEF/9NejaOg6', 0),
                                                       ('c517530e-6d6d-45f2-b689-8ab76584d63c', 'félicien@hotmail.fr', '$2y$12$mooQSIWRiZBGpWbcn1XDre/P8dfjCh7sby80Z9FXC03owF82vhkqW', 0);

-- ===========================================
-- CATEGORIES
-- ===========================================
INSERT INTO categorie (id, nom, description) VALUES
                                                 ('cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d', 'Jardinage', 'Outils pour entretenir le jardin'),
                                                 ('89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f', 'Bricolage', 'Outils de bricolage et réparation'),
                                                 ('9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9', 'Nettoyage', 'Équipements de nettoyage professionnel'),
                                                 ('a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112', 'Peinture', 'Outils et accessoires pour peindre'),
                                                 ('e44a2e22-492f-49a3-bd5e-37b982c18d74', 'Plomberie', 'Outils et matériel de plomberie'),
                                                 ('fbb7b648-81f8-4c84-b1b3-7d0b0db03e88', 'Électricité', 'Outils pour travaux électriques');

-- ===========================================
-- OUTILS
-- ===========================================
INSERT INTO outil (id, nom, description, image, tarif_journalier, quantite_stock, id_cat) VALUES
                                                                                              ('10bfa2c9-1a89-46cb-b74f-4ee879c88b90', 'Tondeuse thermique', 'Pour grandes surfaces', 'tondeuse.jpg', 25.00, 5, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('29cf5f38-8f21-44a8-a4ac-3debe8e55b10', 'Taille-haie électrique', 'Coupe précise', 'taillehaie.jpg', 20.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('3b7289f2-24a1-44a9-8c61-51ff6d1e5a71', 'Souffleur à feuilles', 'Souffleur 2500W', 'souffleur.jpg', 18.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 'Perceuse sans fil', 'Perceuse 18V', 'perceuse.jpg', 15.00, 10, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('56afeb83-cbf1-4786-9ed4-7d1eb478b919', 'Scie sauteuse', 'Scie pour bois et PVC', 'scie.jpg', 14.00, 8, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('66cfeeb1-0c0a-4f1f-bcf2-85e0f4b57420', 'Ponceuse orbitale', 'Finition bois et métal', 'ponceuse.jpg', 12.00, 6, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 'Nettoyeur haute pression', 'Kärcher 2000W', 'karcher.jpg', 30.00, 3, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 'Aspirateur industriel', 'Aspiration puissante', 'aspirateur.jpg', 25.00, 5, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 'Pistolet à peinture', 'Pulvérisateur 800W', 'pistolet.jpg', 18.00, 7, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('b3d2e9f7-3f0a-4414-9b2c-4eb79ed5cf01', 'Échafaudage alu', 'Hauteur 4m', 'echafaudage.jpg', 35.00, 2, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 'Coupe-tube cuivre', 'Pour tubes jusqu’à 40mm', 'coupetube.jpg', 10.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('d8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 'Déboucheur électrique', 'Spirale 15m', 'deboucheur.jpg', 22.00, 5, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('e6d2a91a-8f4f-4f12-a4b4-43c79e2f08f8', 'Multimètre numérique', 'Mesure tension et intensité', 'multimetre.jpg', 8.00, 15, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 'Perforateur SDS', 'Perforateur béton 850W', 'perforateur.jpg', 19.00, 7, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('10e2f9c1-1a4f-4f6b-9d0c-8f4f4f8c01a2', 'Tondeuse électrique', 'Silencieuse 1800W', 'tondeuse_elec.jpg', 22.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('21a8c3d2-9b7e-4c9a-a7e9-8f6f4a3e23b9', 'Taille-haie sans fil', 'Batterie 36V longue autonomie', 'taillehaie_sansfil.jpg', 23.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('32b7e6f9-3d8a-4f0b-bb6d-2c4a1f9e45a8', 'Scarificateur', 'Élimine la mousse du gazon', 'scarificateur.jpg', 26.00, 3, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('43c2f7a1-5b4e-4e2f-bf0a-1c8e8a4e57f1', 'Motobineuse', 'Prépare le sol avant semis', 'motobineuse.jpg', 30.00, 2, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('54f6a8e4-7b9e-45d4-a6f3-2a9e7a5d62b0', 'Tronçonneuse thermique', 'Guide 45cm pour bois dur', 'tronconneuse.jpg', 28.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('65b3f9d1-8c6e-4c1e-9b3a-5f8a9c6e84a7', 'Coupe-bordures', 'Finition de pelouse précise', 'coupebordure.jpg', 14.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('76a1e2c3-3b9a-4f5d-8a7e-9f2a7c8e75a6', 'Aspirateur à feuilles', 'Ramassage rapide', 'aspifeuilles.jpg', 20.00, 5, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('87b6d3e5-1a2b-47d3-b9f6-1b4e9c7f11a2', 'Perceuse à percussion', '700W pour béton et métal', 'perceuse_percussion.jpg', 17.00, 8, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('98e4a2b3-4c5d-4a7e-b9a6-2f4e1a5c33f7', 'Perceuse colonne', 'Haute précision atelier', 'perceuse_colonne.jpg', 25.00, 3, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('a7e2c1b3-6f4d-4d3f-b9e7-4a5b2f6c44f1', 'Tournevis électrique', 'Recharge USB', 'tournevis_elec.jpg', 9.00, 12, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('b8f3e2a1-5a4b-47c5-b8f6-2c3e5a6b12a3', 'Marteau perforateur', '1000W anti-vibration', 'marteau_perfo.jpg', 21.00, 5, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('c9b7a4d3-8b2f-4c9e-b7a2-3e8b9d5f77a1', 'Scie circulaire', 'Lame 190mm 1400W', 'scie_circulaire.jpg', 16.00, 7, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('d1c2b3e4-4a5b-4d7e-b9c8-1f4b2c6d81a7', 'Meuleuse d’angle', 'Disque 125mm', 'meuleuse.jpg', 15.00, 9, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('e2f3a4b5-9b6e-4d5a-a7b3-8c5f2d9a32a6', 'Rabot électrique', 'Finition menuiserie', 'rabot.jpg', 13.00, 6, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('f3e4b2a1-6c5d-4a2f-b7d3-4e8c9b6f44a7', 'Nettoyeur vapeur', 'Désinfection sans produit', 'vapeur.jpg', 28.00, 4, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('a1b2c3d4-5e6f-4a8b-b9c7-2d8f9a1b77f8', 'Aspirateur eau et poussière', 'Cuve 30L', 'aspieau.jpg', 26.00, 5, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('b2c3d4e5-7f8a-4b6e-a7c8-3f9a1e2d88b9', 'Lave-vitre électrique', 'Pour vitres et baies vitrées', 'lavevitre.jpg', 12.00, 8, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('c3d4e5f6-8a9b-4c7f-a8d9-4b1c2a3d99a1', 'Shampouineuse moquette', 'Nettoyage en profondeur', 'shampooinseuse.jpg', 30.00, 3, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('d4e5f6a7-9b1c-4d8e-a9b2-5c2d3e4f11b2', 'Polisseuse auto', 'Finition carrosserie', 'polisseuse.jpg', 18.00, 6, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('e5f6a7b8-1c2d-4e9f-b1a3-6d3e4f5a22c3', 'Pistolet à peinture airless', 'Peinture murs et plafonds', 'pistolet_airless.jpg', 20.00, 5, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('f6a7b8c9-2d3e-4f1a-b2c4-7e4f5a6b33d4', 'Rouleau télescopique', 'Peindre plafonds hauts', 'rouleau_telescopique.jpg', 6.00, 15, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('a7b8c9d1-3e4f-4a2b-b3d5-8f5a6b7c44e5', 'Pistolet à peinture basse pression', 'Finition bois et métal', 'pistolet_bp.jpg', 17.00, 7, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('c9d1e2f3-5a6b-4c4d-b5f7-1b7c8d9e66a7', 'Mélangeur de peinture', 'Fixation perceuse', 'melangeur.jpg', 4.00, 10, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('d1e2f3a4-6b7c-4d5e-b6a8-2c8d9e1f77b8', 'Décolleuse papier peint', 'Réservoir 5L vapeur', 'decolleuse.jpg', 14.00, 4, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('e2f3a4b5-7c8d-4e6f-b7a9-3d9e1f2a88c9', 'Clé à molette', 'Réglable 200mm', 'clemolette.jpg', 5.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('f3a4b5c6-8d9e-4f7a-b8c1-4e1f2a3b99d1', 'Pince multiprise', 'Poignée ergonomique', 'pincemulti.jpg', 4.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('a4b5c6d7-9e1f-4a8b-b9c2-5f2a3b4c11e2', 'Coupe-tube PVC', 'Diamètre jusqu’à 50mm', 'coupetube_pvc.jpg', 8.00, 6, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('b5c6d7e8-1f2a-4b9c-b1d3-6a3b4c5d22f3', 'Clé à sangle', 'Pour raccords difficiles', 'clesangle.jpg', 6.00, 8, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('c6d7e8f9-2a3b-4c1d-b2e4-7b4c5d6e33a4', 'Déboucheur manuel', 'Pompe à pression', 'deboucheur_manuel.jpg', 10.00, 5, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('d7e8f9a1-3b4c-4d2e-b3f5-8c5d6e7f44b5', 'Testeur de tension', 'Affichage LED', 'testeur_tension.jpg', 6.00, 12, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('e8f9a1b2-4c5d-4e3f-b4a6-9d6e7f8a55c6', 'Fer à souder', 'Station 60W température réglable', 'fer_souder.jpg', 14.00, 8, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('f9a1b2c3-5d6e-4f4a-b5c7-1e7f8a9b66d7', 'Pince à dénuder', 'Câbles jusqu’à 6mm²', 'pince_denuder.jpg', 5.00, 10, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('a1b2c3d4-6e7f-4a5b-b6d8-2f8a9b1c77e8', 'Multimètre analogique', 'Tension et résistance', 'multimetre_analog.jpg', 7.00, 9, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('b2c3d4e5-7f8a-4b6c-b7e9-3a9b1c2d88f9', 'Détecteur de câble', 'Repérage dans mur', 'detecteur_cable.jpg', 9.00, 7, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('c3d4e5f6-8a9b-4c7d-b8f1-4b1c2d3e99a0', 'Lampe frontale rechargeable', 'Éclairage chantier', 'lampefrontale.jpg', 4.00, 15, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('d4e5f6a7-9b1c-4d8e-b9f2-5c2d3e4f11a3', 'Perforateur burineur', 'Mode marteau seul', 'perfo_burineur.jpg', 22.00, 5, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f');


-- ===========================================
-- PANIERS
-- ===========================================
INSERT INTO panier (id, id_user) VALUES
                                     ('9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '453a3455-5f4a-4e3b-b18f-339a5322cf67'),
                                     ('a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', '39d2c4f8-e022-4778-8043-d57fb76066e7'),
                                     ('5ed9bfea-faa9-4ca2-b80e-7136bb5b6cb9', '725b85b8-d42f-40b2-a42a-74cbc4ad0b37'),
                                     ('1107bf58-9509-4da7-b7a7-31b692bf6a00', 'c517530e-6d6d-45f2-b689-8ab76584d63c');

-- ===========================================
-- PANIER_OUTIL
-- ===========================================
INSERT INTO panier_outil (id, id_panier, id_outil, quantite, date_reservation) VALUES
                                                                                   ('a1df6b1e-b25e-47cd-a0f5-b7f84b9e4151', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1, '2025-10-21'),
                                                                                   ('b4a9e7f8-29a1-4ad4-b9b7-0e7e416f5e34', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1, '2025-10-22'),
                                                                                   ('c2b9d3e4-8d1f-4988-9b5b-4f3f8d92e981', 'a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1, '2025-10-23');

-- ===========================================
-- RESERVATIONS
-- ===========================================
INSERT INTO reservation (id, id_user, date_debut, date_fin, statut) VALUES
                                                                        ('e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '453a3455-5f4a-4e3b-b18f-339a5322cf67', '2025-10-20', '2025-10-23', 'confirmee'),
                                                                        ('d7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', '725b85b8-d42f-40b2-a42a-74cbc4ad0b37', '2025-10-21', '2025-10-24', 'en_attente'),
                                                                        ('b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'c517530e-6d6d-45f2-b689-8ab76584d63c', '2025-10-22', '2025-10-25', 'confirmee');

-- ===========================================
-- RESERVATION_OUTIL
-- ===========================================
INSERT INTO reservation_outil (id, id_reservation, id_outil, quantite) VALUES

                                                                           ('111b8f4b-98d4-4a35-8f67-4c1e7a13b8a4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 2),
                                                                           ('222b8f4b-77c4-49a1-87c3-4f1e7a13a9b9', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '56afeb83-cbf1-4786-9ed4-7d1eb478b919', 1),
                                                                           ('333b8f4b-66a4-42a5-83c3-4e1e7a13b9c4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1),

                                                                           ('444b8f4b-12e4-4a35-83c7-4d1e7a13b8f1', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1),
                                                                           ('555b8f4b-11c4-49a1-87c1-4a1e7a13a9e2', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 1),
                                                                           ('666b8f4b-15a4-42a5-83a9-4b1e7a13b9f3', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', '88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 1),

                                                                           ('777b8f4b-19a4-41a5-84a9-4c1e7a13b9e1', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'd8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 1),
                                                                           ('888b8f4b-16b4-42b5-85a9-4e1e7a13b9d2', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1),
                                                                           ('999b8f4b-13c4-43c5-86a9-4f1e7a13b9c3', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 1);


-- Table Users
CREATE TABLE "users" (
                         "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                         "email" VARCHAR(255) UNIQUE NOT NULL,
                         "password_hash" TEXT NOT NULL,
                         "role" INTEGER NOT NULL DEFAULT 0,
                         "cree_par" UUID,
                         "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         "modifie_par" UUID,
                         "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Categorie
CREATE TABLE "categorie" (
                             "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                             "nom" VARCHAR(255) NOT NULL,
                             "description" TEXT,
                             "cree_par" UUID,
                             "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             "modifie_par" UUID,
                             "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Outil
CREATE TABLE "outil" (
                         "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                         "nom" VARCHAR(255) NOT NULL,
                         "description" TEXT,
                         "image" VARCHAR(255),
                         "tarif_journalier" DOUBLE PRECISION NOT NULL,
                         "quantite_stock" INT NOT NULL,
                         "id_cat" UUID REFERENCES "categorie"("id") ON DELETE SET NULL,
                         "cree_par" UUID,
                         "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         "modifie_par" UUID,
                         "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Panier
CREATE TABLE "panier" (
                          "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                          "id_user" UUID REFERENCES "users"("id") ON DELETE CASCADE,
                          "cree_par" UUID,
                          "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          "modifie_par" UUID,
                          "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Panier_Outil
CREATE TABLE "panier_outil" (
                                "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                                "id_panier" UUID REFERENCES "panier"("id") ON DELETE CASCADE,
                                "id_outil" UUID REFERENCES "outil"("id") ON DELETE CASCADE,
                                "quantite" INT NOT NULL DEFAULT 1,
                                "date_reservation" DATE NOT NULL,
                                "cree_par" UUID,
                                "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                "modifie_par" UUID,
                                "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Reservation
CREATE TABLE "reservation" (
                               "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                               "id_user" UUID REFERENCES "users"("id") ON DELETE CASCADE,
                               "date_debut" DATE NOT NULL,
                               "date_fin" DATE NOT NULL,
                               "statut" VARCHAR(20) NOT NULL DEFAULT 'en_attente',
                               "cree_par" UUID,
                               "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                               "modifie_par" UUID,
                               "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Reservation_Outil
CREATE TABLE "reservation_outil" (
                                     "id" UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                                     "id_reservation" UUID REFERENCES "reservation"("id") ON DELETE CASCADE,
                                     "id_outil" UUID REFERENCES "outil"("id") ON DELETE CASCADE,
                                     "quantite" INT NOT NULL DEFAULT 1,
                                     "cree_par" UUID,
                                     "cree_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                     "modifie_par" UUID,
                                     "modifie_quand" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===========================================
-- USERS
-- ===========================================
INSERT INTO users (id, email, password_hash, role) VALUES
                                                       ('453a3455-5f4a-4e3b-b18f-339a5322cf67', 'eloi@hotmail.fr', '$2y$12$1lnw1PyeggiOzlO2q49Ht.YsljsyDAoG01tLwxGFzU.mXymmeAuRK', 0),
                                                       ('39d2c4f8-e022-4778-8043-d57fb76066e7', 'tuline@hotmail.fr', '$2y$12$OuGfvNKN9Bcv4vZHnM00aO6B6l0X8qccQvkcGUwm14/YHIGGESgDu', 0),
                                                       ('725b85b8-d42f-40b2-a42a-74cbc4ad0b37', 'hugo@hotmail.fr', '$2y$12$vfz5XU9.4DMhI0dZa6ujIOvCZ1Pf7ipmm0JQ776/hmEF/9NejaOg6', 0),
                                                       ('c517530e-6d6d-45f2-b689-8ab76584d63c', 'félicien@hotmail.fr', '$2y$12$mooQSIWRiZBGpWbcn1XDre/P8dfjCh7sby80Z9FXC03owF82vhkqW', 0);

-- ===========================================
-- CATEGORIES
-- ===========================================
INSERT INTO categorie (id, nom, description) VALUES
                                                 ('cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d', 'Jardinage', 'Outils pour entretenir le jardin'),
                                                 ('89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f', 'Bricolage', 'Outils de bricolage et réparation'),
                                                 ('9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9', 'Nettoyage', 'Équipements de nettoyage professionnel'),
                                                 ('a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112', 'Peinture', 'Outils et accessoires pour peindre'),
                                                 ('e44a2e22-492f-49a3-bd5e-37b982c18d74', 'Plomberie', 'Outils et matériel de plomberie'),
                                                 ('fbb7b648-81f8-4c84-b1b3-7d0b0db03e88', 'Électricité', 'Outils pour travaux électriques');

-- ===========================================
-- OUTILS
-- ===========================================
INSERT INTO outil (id, nom, description, image, tarif_journalier, quantite_stock, id_cat) VALUES
                                                                                              ('10bfa2c9-1a89-46cb-b74f-4ee879c88b90', 'Tondeuse thermique', 'Pour grandes surfaces', 'tondeuse.jpg', 25.00, 5, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('29cf5f38-8f21-44a8-a4ac-3debe8e55b10', 'Taille-haie électrique', 'Coupe précise', 'taillehaie.jpg', 20.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('3b7289f2-24a1-44a9-8c61-51ff6d1e5a71', 'Souffleur à feuilles', 'Souffleur 2500W', 'souffleur.jpg', 18.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 'Perceuse sans fil', 'Perceuse 18V', 'perceuse.jpg', 15.00, 10, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('56afeb83-cbf1-4786-9ed4-7d1eb478b919', 'Scie sauteuse', 'Scie pour bois et PVC', 'scie.jpg', 14.00, 8, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('66cfeeb1-0c0a-4f1f-bcf2-85e0f4b57420', 'Ponceuse orbitale', 'Finition bois et métal', 'ponceuse.jpg', 12.00, 6, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 'Nettoyeur haute pression', 'Kärcher 2000W', 'karcher.jpg', 30.00, 3, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 'Aspirateur industriel', 'Aspiration puissante', 'aspirateur.jpg', 25.00, 5, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 'Pistolet à peinture', 'Pulvérisateur 800W', 'pistolet.jpg', 18.00, 7, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('b3d2e9f7-3f0a-4414-9b2c-4eb79ed5cf01', 'Échafaudage alu', 'Hauteur 4m', 'echafaudage.jpg', 35.00, 2, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 'Coupe-tube cuivre', 'Pour tubes jusqu’à 40mm', 'coupetube.jpg', 10.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('d8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 'Déboucheur électrique', 'Spirale 15m', 'deboucheur.jpg', 22.00, 5, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('e6d2a91a-8f4f-4f12-a4b4-43c79e2f08f8', 'Multimètre numérique', 'Mesure tension et intensité', 'multimetre.jpg', 8.00, 15, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 'Perforateur SDS', 'Perforateur béton 850W', 'perforateur.jpg', 19.00, 7, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('10e2f9c1-1a4f-4f6b-9d0c-8f4f4f8c01a2', 'Tondeuse électrique', 'Silencieuse 1800W', 'tondeuse_elec.jpg', 22.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('21a8c3d2-9b7e-4c9a-a7e9-8f6f4a3e23b9', 'Taille-haie sans fil', 'Batterie 36V longue autonomie', 'taillehaie_sansfil.jpg', 23.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('32b7e6f9-3d8a-4f0b-bb6d-2c4a1f9e45a8', 'Scarificateur', 'Élimine la mousse du gazon', 'scarificateur.jpg', 26.00, 3, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('43c2f7a1-5b4e-4e2f-bf0a-1c8e8a4e57f1', 'Motobineuse', 'Prépare le sol avant semis', 'motobineuse.jpg', 30.00, 2, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('54f6a8e4-7b9e-45d4-a6f3-2a9e7a5d62b0', 'Tronçonneuse thermique', 'Guide 45cm pour bois dur', 'tronconneuse.jpg', 28.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('65b3f9d1-8c6e-4c1e-9b3a-5f8a9c6e84a7', 'Coupe-bordures', 'Finition de pelouse précise', 'coupebordure.jpg', 14.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('76a1e2c3-3b9a-4f5d-8a7e-9f2a7c8e75a6', 'Aspirateur à feuilles', 'Ramassage rapide', 'aspifeuilles.jpg', 20.00, 5, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                              ('87b6d3e5-1a2b-47d3-b9f6-1b4e9c7f11a2', 'Perceuse à percussion', '700W pour béton et métal', 'perceuse_percussion.jpg', 17.00, 8, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('98e4a2b3-4c5d-4a7e-b9a6-2f4e1a5c33f7', 'Perceuse colonne', 'Haute précision atelier', 'perceuse_colonne.jpg', 25.00, 3, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('a7e2c1b3-6f4d-4d3f-b9e7-4a5b2f6c44f1', 'Tournevis électrique', 'Recharge USB', 'tournevis_elec.jpg', 9.00, 12, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('b8f3e2a1-5a4b-47c5-b8f6-2c3e5a6b12a3', 'Marteau perforateur', '1000W anti-vibration', 'marteau_perfo.jpg', 21.00, 5, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('c9b7a4d3-8b2f-4c9e-b7a2-3e8b9d5f77a1', 'Scie circulaire', 'Lame 190mm 1400W', 'scie_circulaire.jpg', 16.00, 7, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('d1c2b3e4-4a5b-4d7e-b9c8-1f4b2c6d81a7', 'Meuleuse d’angle', 'Disque 125mm', 'meuleuse.jpg', 15.00, 9, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('e2f3a4b5-9b6e-4d5a-a7b3-8c5f2d9a32a6', 'Rabot électrique', 'Finition menuiserie', 'rabot.jpg', 13.00, 6, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                              ('f3e4b2a1-6c5d-4a2f-b7d3-4e8c9b6f44a7', 'Nettoyeur vapeur', 'Désinfection sans produit', 'vapeur.jpg', 28.00, 4, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('a1b2c3d4-5e6f-4a8b-b9c7-2d8f9a1b77f8', 'Aspirateur eau et poussière', 'Cuve 30L', 'aspieau.jpg', 26.00, 5, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('b2c3d4e5-7f8a-4b6e-a7c8-3f9a1e2d88b9', 'Lave-vitre électrique', 'Pour vitres et baies vitrées', 'lavevitre.jpg', 12.00, 8, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('c3d4e5f6-8a9b-4c7f-a8d9-4b1c2a3d99a1', 'Shampouineuse moquette', 'Nettoyage en profondeur', 'shampooinseuse.jpg', 30.00, 3, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('d4e5f6a7-9b1c-4d8e-a9b2-5c2d3e4f11b2', 'Polisseuse auto', 'Finition carrosserie', 'polisseuse.jpg', 18.00, 6, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                              ('e5f6a7b8-1c2d-4e9f-b1a3-6d3e4f5a22c3', 'Pistolet à peinture airless', 'Peinture murs et plafonds', 'pistolet_airless.jpg', 20.00, 5, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('f6a7b8c9-2d3e-4f1a-b2c4-7e4f5a6b33d4', 'Rouleau télescopique', 'Peindre plafonds hauts', 'rouleau_telescopique.jpg', 6.00, 15, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('a7b8c9d1-3e4f-4a2b-b3d5-8f5a6b7c44e5', 'Pistolet à peinture basse pression', 'Finition bois et métal', 'pistolet_bp.jpg', 17.00, 7, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('c9d1e2f3-5a6b-4c4d-b5f7-1b7c8d9e66a7', 'Mélangeur de peinture', 'Fixation perceuse', 'melangeur.jpg', 4.00, 10, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('d1e2f3a4-6b7c-4d5e-b6a8-2c8d9e1f77b8', 'Décolleuse papier peint', 'Réservoir 5L vapeur', 'decolleuse.jpg', 14.00, 4, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                              ('e2f3a4b5-7c8d-4e6f-b7a9-3d9e1f2a88c9', 'Clé à molette', 'Réglable 200mm', 'clemolette.jpg', 5.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('f3a4b5c6-8d9e-4f7a-b8c1-4e1f2a3b99d1', 'Pince multiprise', 'Poignée ergonomique', 'pincemulti.jpg', 4.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('a4b5c6d7-9e1f-4a8b-b9c2-5f2a3b4c11e2', 'Coupe-tube PVC', 'Diamètre jusqu’à 50mm', 'coupetube_pvc.jpg', 8.00, 6, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('b5c6d7e8-1f2a-4b9c-b1d3-6a3b4c5d22f3', 'Clé à sangle', 'Pour raccords difficiles', 'clesangle.jpg', 6.00, 8, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('c6d7e8f9-2a3b-4c1d-b2e4-7b4c5d6e33a4', 'Déboucheur manuel', 'Pompe à pression', 'deboucheur_manuel.jpg', 10.00, 5, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                              ('d7e8f9a1-3b4c-4d2e-b3f5-8c5d6e7f44b5', 'Testeur de tension', 'Affichage LED', 'testeur_tension.jpg', 6.00, 12, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('e8f9a1b2-4c5d-4e3f-b4a6-9d6e7f8a55c6', 'Fer à souder', 'Station 60W température réglable', 'fer_souder.jpg', 14.00, 8, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('f9a1b2c3-5d6e-4f4a-b5c7-1e7f8a9b66d7', 'Pince à dénuder', 'Câbles jusqu’à 6mm²', 'pince_denuder.jpg', 5.00, 10, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('a1b2c3d4-6e7f-4a5b-b6d8-2f8a9b1c77e8', 'Multimètre analogique', 'Tension et résistance', 'multimetre_analog.jpg', 7.00, 9, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('b2c3d4e5-7f8a-4b6c-b7e9-3a9b1c2d88f9', 'Détecteur de câble', 'Repérage dans mur', 'detecteur_cable.jpg', 9.00, 7, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('c3d4e5f6-8a9b-4c7d-b8f1-4b1c2d3e99a0', 'Lampe frontale rechargeable', 'Éclairage chantier', 'lampefrontale.jpg', 4.00, 15, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                              ('d4e5f6a7-9b1c-4d8e-b9f2-5c2d3e4f11a3', 'Perforateur burineur', 'Mode marteau seul', 'perfo_burineur.jpg', 22.00, 5, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f');


-- ===========================================
-- PANIERS
-- ===========================================
INSERT INTO panier (id, id_user) VALUES
                                     ('9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '453a3455-5f4a-4e3b-b18f-339a5322cf67'),
                                     ('a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', '39d2c4f8-e022-4778-8043-d57fb76066e7'),
                                     ('5ed9bfea-faa9-4ca2-b80e-7136bb5b6cb9', '725b85b8-d42f-40b2-a42a-74cbc4ad0b37'),
                                     ('1107bf58-9509-4da7-b7a7-31b692bf6a00', 'c517530e-6d6d-45f2-b689-8ab76584d63c');

-- ===========================================
-- PANIER_OUTIL
-- ===========================================
INSERT INTO panier_outil (id, id_panier, id_outil, quantite, date_reservation) VALUES
                                                                                   ('a1df6b1e-b25e-47cd-a0f5-b7f84b9e4151', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1, '2025-10-21'),
                                                                                   ('b4a9e7f8-29a1-4ad4-b9b7-0e7e416f5e34', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1, '2025-10-22'),
                                                                                   ('c2b9d3e4-8d1f-4988-9b5b-4f3f8d92e981', 'a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1, '2025-10-23');

-- ===========================================
-- RESERVATIONS
-- ===========================================
INSERT INTO reservation (id, id_user, date_debut, date_fin, statut) VALUES
                                                                        ('e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '453a3455-5f4a-4e3b-b18f-339a5322cf67', '2025-10-20', '2025-10-23', 'confirmee'),
                                                                        ('d7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', '725b85b8-d42f-40b2-a42a-74cbc4ad0b37', '2025-10-21', '2025-10-24', 'en_attente'),
                                                                        ('b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'c517530e-6d6d-45f2-b689-8ab76584d63c', '2025-10-22', '2025-10-25', 'confirmee');

-- ===========================================
-- RESERVATION_OUTIL
-- ===========================================
INSERT INTO reservation_outil (id, id_reservation, id_outil, quantite) VALUES

                                                                           ('111b8f4b-98d4-4a35-8f67-4c1e7a13b8a4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 2),
                                                                           ('222b8f4b-77c4-49a1-87c3-4f1e7a13a9b9', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '56afeb83-cbf1-4786-9ed4-7d1eb478b919', 1),
                                                                           ('333b8f4b-66a4-42a5-83c3-4e1e7a13b9c4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1),

                                                                           ('444b8f4b-12e4-4a35-83c7-4d1e7a13b8f1', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1),
                                                                           ('555b8f4b-11c4-49a1-87c1-4a1e7a13a9e2', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 1),
                                                                           ('666b8f4b-15a4-42a5-83a9-4b1e7a13b9f3', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', '88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 1),

                                                                           ('777b8f4b-19a4-41a5-84a9-4c1e7a13b9e1', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'd8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 1),
                                                                           ('888b8f4b-16b4-42b5-85a9-4e1e7a13b9d2', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1),
                                                                           ('999b8f4b-13c4-43c5-86a9-4f1e7a13b9c3', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 1);
