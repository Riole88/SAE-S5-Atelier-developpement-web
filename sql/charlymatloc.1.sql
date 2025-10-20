CREATE EXTENSION IF NOT EXISTS "pgcrypto";
DROP TABLE IF EXISTS panier_outil;
DROP TABLE IF EXISTS reservation_outil;
DROP TABLE IF EXISTS panier;
DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS outil;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS users;

-- Table Users
CREATE TABLE users (
                       id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                       email VARCHAR(255) UNIQUE NOT NULL,
                       passwordHash TEXT NOT NULL,
                       role INTEGER NOT NULL DEFAULT 0,
                       cree_par UUID,
                       cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       modifie_par UUID,
                       modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Categorie
CREATE TABLE categorie (
                           id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                           nom VARCHAR(255) NOT NULL,
                           description TEXT,
                           cree_par UUID,
                           cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                           modifie_par UUID,
                           modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Outil
CREATE TABLE outil (
                       id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                       nom VARCHAR(255) NOT NULL,
                       description TEXT,
                       image VARCHAR(255),
                       tarifJournalier DOUBLE PRECISION NOT NULL,
                       quantiteStock INT NOT NULL,
                       idCat UUID REFERENCES categorie(id) ON DELETE SET NULL,
                       cree_par UUID,
                       cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       modifie_par UUID,
                       modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Panier
CREATE TABLE panier (
                        id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                        idUser UUID REFERENCES users(id) ON DELETE CASCADE,
                        cree_par UUID,
                        cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        modifie_par UUID,
                        modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Panier_Outil
CREATE TABLE panier_outil (
                              id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                              idPanier UUID REFERENCES panier(id) ON DELETE CASCADE,
                              idOutil UUID REFERENCES outil(id) ON DELETE CASCADE,
                              quantite INT NOT NULL DEFAULT 1,
                              dateReservation DATE NOT NULL,
                              cree_par UUID,
                              cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              modifie_par UUID,
                              modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Reservation
CREATE TABLE reservation (
                             id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                             idUser UUID REFERENCES users(id) ON DELETE CASCADE,
                             dateDebut DATE NOT NULL,
                             dateFin DATE NOT NULL,
                             statut VARCHAR(20) NOT NULL DEFAULT 'en_attente',
                             cree_par UUID,
                             cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             modifie_par UUID,
                             modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Reservation_Outil
CREATE TABLE reservation_outil (
                                   id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                                   idReservation UUID REFERENCES reservation(id) ON DELETE CASCADE,
                                   idOutil UUID REFERENCES outil(id) ON DELETE CASCADE,
                                   quantite INT NOT NULL DEFAULT 1,
                                   cree_par UUID,
                                   cree_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                   modifie_par UUID,
                                   modifie_quand TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
