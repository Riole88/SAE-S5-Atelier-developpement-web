-- ===========================================
-- USERS
-- ===========================================
INSERT INTO users (id, email, passwordhash, role) VALUES
                                                                ('a7e94d9a-4ef4-4d7b-bb2c-64f6c8a2d2e1', 'admin@example.com', 'hash_admin', 100),
                                                                ('b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', 'client1@example.com', 'hash_client1', 0),
                                                                ('e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1', 'client2@example.com', 'hash_client2', 0);

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
INSERT INTO outil (id, nom, description, image, tarifJournalier, quantiteStock, idCat) VALUES
                                                                                                           ('10bfa2c9-1a89-46cb-b74f-4ee879c88b90', 'Tondeuse thermique', 'Pour grandes surfaces', 'tondeuse.jpg', 25.00, 5, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                                           ('29cf5f38-8f21-44a8-a4ac-3debe8e55b10', 'Taille-haie électrique', 'Coupe précise', 'taillehaie.jpg', 20.00, 6, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                                           ('3b7289f2-24a1-44a9-8c61-51ff6d1e5a71', 'Souffleur à feuilles', 'Souffleur 2500W', 'souffleur.jpg', 18.00, 4, 'cbbf6b54-9b13-4a2e-b49c-7f9262d55d8d'),
                                                                                                           ('48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 'Perceuse sans fil', 'Perceuse 18V', 'perceuse.jpg', 15.00, 10, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                                           ('56afeb83-cbf1-4786-9ed4-7d1eb478b919', 'Scie sauteuse', 'Scie pour bois et PVC', 'scie.jpg', 14.00, 8, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                                           ('66cfeeb1-0c0a-4f1f-bcf2-85e0f4b57420', 'Ponceuse orbitale', 'Finition bois et métal', 'ponceuse.jpg', 12.00, 6, '89b7f3e3-19b1-41df-bf1d-54ef5cf03a2f'),
                                                                                                           ('79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 'Nettoyeur haute pression', 'Kärcher 2000W', 'karcher.jpg', 30.00, 3, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                                           ('88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 'Aspirateur industriel', 'Aspiration puissante', 'aspirateur.jpg', 25.00, 5, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                                           ('93a1c4f9-d9b4-49e1-9a9a-23c3f66d6a91', 'Shampoing moquette', 'Nettoyage textile pro', 'shampoing.jpg', 22.00, 4, '9a45c67f-c2c4-4ee8-a37f-7e8c4a3ed3b9'),
                                                                                                           ('a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 'Pistolet à peinture', 'Pulvérisateur 800W', 'pistolet.jpg', 18.00, 7, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                                           ('b3d2e9f7-3f0a-4414-9b2c-4eb79ed5cf01', 'Échafaudage alu', 'Hauteur 4m', 'echafaudage.jpg', 35.00, 2, 'a6e78e0d-6f1c-42f5-bb8a-23a6b7f92112'),
                                                                                                           ('c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 'Coupe-tube cuivre', 'Pour tubes jusqu’à 40mm', 'coupetube.jpg', 10.00, 10, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                                           ('d8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 'Déboucheur électrique', 'Spirale 15m', 'deboucheur.jpg', 22.00, 5, 'e44a2e22-492f-49a3-bd5e-37b982c18d74'),
                                                                                                           ('e6d2a91a-8f4f-4f12-a4b4-43c79e2f08f8', 'Multimètre numérique', 'Mesure tension et intensité', 'multimetre.jpg', 8.00, 15, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88'),
                                                                                                           ('f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 'Perforateur SDS', 'Perforateur béton 850W', 'perforateur.jpg', 19.00, 7, 'fbb7b648-81f8-4c84-b1b3-7d0b0db03e88');

-- ===========================================
-- PANIERS
-- ===========================================
INSERT INTO panier (id, idUser) VALUES
                                          ('9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f'),
                                          ('a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', 'e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1');

-- ===========================================
-- PANIER_OUTIL
-- ===========================================
INSERT INTO panier_outil (id, idPanier, idOutil, quantite, dateReservation) VALUES
                                                                                            ('a1df6b1e-b25e-47cd-a0f5-b7f84b9e4151', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1, '2025-10-21'),
                                                                                            ('b4a9e7f8-29a1-4ad4-b9b7-0e7e416f5e34', '9be3a6c4-53df-4e5b-b0f2-4b7dbf1f4931', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1, '2025-10-22'),
                                                                                            ('c2b9d3e4-8d1f-4988-9b5b-4f3f8d92e981', 'a4c7e2d3-64f9-42e1-94c2-8154efc9cb87', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1, '2025-10-23');

-- ===========================================
-- RESERVATIONS
-- ===========================================
INSERT INTO reservation (id, idUser, dateDebut, dateFin, statut) VALUES
                                                                                 ('e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-20', '2025-10-23', 'confirmee'),
                                                                                 ('d7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1', '2025-10-21', '2025-10-24', 'en_attente'),
                                                                                 ('b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-22', '2025-10-25', 'confirmee'),
                                                                                 ('f1e3a7b9-3b5d-4b3f-a0e2-58cf7b1c83a5', 'e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1', '2025-10-23', '2025-10-26', 'confirmee'),
                                                                                 ('a2f9e3b4-74b1-4f43-bc5e-25c9f83e71a9', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-24', '2025-10-27', 'en_attente'),
                                                                                 ('c4b6a2d3-13e8-43b7-927f-9e2f73d9c8b3', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-25', '2025-10-28', 'confirmee'),
                                                                                 ('a7e3b9d1-5b2a-4b11-bc6e-91f3f7a2d9a1', 'e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1', '2025-10-26', '2025-10-29', 'confirmee'),
                                                                                 ('b2e5f1d7-3a5c-4563-b1a4-4c1b9e1e4d93', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-27', '2025-10-30', 'en_attente'),
                                                                                 ('f9b4a2e3-4b5a-4e3b-9b3a-3b7a1f9d9a91', 'e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1', '2025-10-28', '2025-10-31', 'confirmee'),
                                                                                 ('e1a4f2b7-2b5c-4569-8a7e-7a3f9d5b8a4c', 'b12c59b7-9d2d-4e7c-9f84-cb39f9a1322f', '2025-10-29', '2025-11-01', 'confirmee');

-- ===========================================
-- RESERVATION_OUTIL
-- ===========================================
INSERT INTO reservation_outil (id, idReservation, idOutil, quantite) VALUES
                                                                                   ('111b8f4b-98d4-4a35-8f67-4c1e7a13b8a4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 2),
                                                                                   ('222b8f4b-77c4-49a1-87c3-4f1e7a13a9b9', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '56afeb83-cbf1-4786-9ed4-7d1eb478b919', 1),
                                                                                   ('333b8f4b-66a4-42a5-83c3-4e1e7a13b9c4', 'e9a6f9a8-0b3d-43d4-90b8-223b6b67d3a1', '79b5c6e9-1c5c-4de4-857a-3f29ad73a5e4', 1),

                                                                                   ('444b8f4b-12e4-4a35-83c7-4d1e7a13b8f1', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'a8f2a5e3-82f0-4d93-b0f7-f8e8e2c31f7a', 1),
                                                                                   ('555b8f4b-11c4-49a1-87c1-4a1e7a13a9e2', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', 'c9b5b0a8-b9f3-4c1e-8b33-cfa791a8d0a4', 1),
                                                                                   ('666b8f4b-15a4-42a5-83a9-4b1e7a13b9f3', 'd7c2b8b1-6e49-456c-b3e9-0b73f93a91a3', '88d6f42b-7b1a-4a61-b3ee-81b7d8c34f14', 1),

                                                                                   ('777b8f4b-19a4-41a5-84a9-4c1e7a13b9e1', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'd8cf91f1-45f1-4d62-96a0-fda5c1e07f19', 1),
                                                                                   ('888b8f4b-16b4-42b5-85a9-4e1e7a13b9d2', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', '48efb313-9e46-4cc5-bf53-1a7a3e9a5c04', 1),
                                                                                   ('999b8f4b-13c4-43c5-86a9-4f1e7a13b9c3', 'b5a4c7d3-1e8b-4a95-9a23-6b4cf72b9f17', 'f2b5a79d-7a3e-4b3b-9208-17cb7a19b87e', 1);
