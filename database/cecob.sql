CREATE DATABASE IF NOT EXISTS cecob CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cecob;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NULL,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    account_status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
);

CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    member_number VARCHAR(50) NOT NULL UNIQUE,
    university VARCHAR(150) NOT NULL,
    faculty VARCHAR(150) DEFAULT NULL,
    department VARCHAR(150) DEFAULT NULL,
    academic_level VARCHAR(100) DEFAULT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE adhesion_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birth_date DATE NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    university VARCHAR(150) NOT NULL,
    faculty VARCHAR(150) NOT NULL,
    department VARCHAR(150) NOT NULL,
    academic_level VARCHAR(100) NOT NULL,
    student_id VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    supporting_documents TEXT NULL,
    review_status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    category VARCHAR(100) NOT NULL,
    excerpt TEXT NOT NULL,
    body LONGTEXT NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'published',
    published_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    starts_at DATETIME NOT NULL,
    location VARCHAR(200) NOT NULL,
    capacity INT NOT NULL DEFAULT 0,
    image_path VARCHAR(255) DEFAULT NULL
);

CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    role_title VARCHAR(150) NOT NULL,
    bio TEXT NOT NULL,
    avatar_path VARCHAR(255) DEFAULT NULL,
    mandate_start VARCHAR(20) NOT NULL,
    mandate_end VARCHAR(20) NOT NULL,
    display_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    logo_path VARCHAR(255) DEFAULT NULL,
    website_url VARCHAR(255) DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NULL,
    amount DECIMAL(12,2) NOT NULL,
    method VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    paid_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE SET NULL
);

CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    visibility VARCHAR(50) NOT NULL DEFAULT 'public',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'new',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roles (name, slug) VALUES
('Super Admin', 'super_admin'),
('President', 'president'),
('Secretary', 'secretary'),
('Treasurer', 'treasurer');

INSERT INTO users (role_id, full_name, email, password_hash, account_status) VALUES
(1, 'Administrateur CECOB', 'admin@cecob.local', '$2y$10$hulybFaRBAwS/tBYxoaKq.LfXt4zbWqpzcsWDRr5VTkL5At16bAHC', 'active');

INSERT INTO posts (title, slug, category, excerpt, body, image_path, status, published_at) VALUES
('CECOB lance sa plateforme de gestion complete', 'cecob-plateforme-gestion', 'Vie associative', 'Le portail centralise l’adhesion, les membres, les evenements et les finances.', 'Cette premiere version proceduralise les points d’entree publics et administratifs tout en gardant le design existant.', 'assets/images/blog/blogpost-3.jpg', 'published', NOW()),
('Ouverture officielle des adhesions 2026', 'ouverture-adhesions-2026', 'Communique', 'Les etudiants peuvent soumettre leur demande en ligne.', 'La campagne d’adhesion est ouverte avec un workflow de verification par le secretariat.', 'assets/images/blog/blogpost-1.jpg', 'published', NOW());

INSERT INTO events (title, description, starts_at, location, capacity, image_path) VALUES
('Forum d’integration', 'Presentation de l’association, du mentorat et du processus d’adhesion.', '2026-05-24 09:00:00', 'Universite du Burundi', 250, 'assets/images/education/edu-webinar-1.jpg'),
('Conference leadership etudiant', 'Conference institutionnelle avec panels et partenaires academiques.', '2026-06-07 14:00:00', 'Bujumbura', 120, 'assets/images/education/edu-webinar-2.jpg');

INSERT INTO team_members (full_name, role_title, bio, avatar_path, mandate_start, mandate_end, display_order, is_active) VALUES
('Aline Mukendi', 'Presidente', 'Pilotage strategique, partenariats et coordination institutionnelle.', 'assets/images/avatar/avatar-1.jpg', '2026', '2027', 1, 1),
('Patrick Kanku', 'Secretaire general', 'Validation des adhesions et suivi documentaire.', 'assets/images/avatar/avatar-2.jpg', '2026', '2027', 2, 1),
('Naomi Ilunga', 'Tresoriere', 'Cotisations, rapports mensuels et transparence financiere.', 'assets/images/avatar/avatar-3.jpg', '2026', '2027', 3, 1);

INSERT INTO partners (name, description, logo_path, website_url) VALUES
('Partenaire academique', 'Accompagnement universitaire et orientation.', 'assets/images/brand/dropbox-logo.svg', 'https://example.org');

INSERT INTO payments (member_id, amount, method, status, paid_at) VALUES
(NULL, 25000, 'Mobile money', 'paid', NOW()),
(NULL, 15000, 'Cash', 'pending', NULL);
