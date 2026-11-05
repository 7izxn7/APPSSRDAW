CREATE DATABASE IF NOT EXISTS AppSSR;
USE AppSSR;

-- Tabla de usuarios
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB;

-- Tabla de proyectos
CREATE TABLE projects (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    status VARCHAR(255) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_projects_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla intermedia: participación de usuarios
CREATE TABLE user_project (
    user_id BIGINT UNSIGNED NOT NULL,
    project_id BIGINT UNSIGNED NOT NULL,
    role VARCHAR(255) NOT NULL,
    contribution_hours INT UNSIGNED NOT NULL DEFAULT 0,

    PRIMARY KEY (user_id, project_id),

    CONSTRAINT fk_user_project_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_user_project_project
        FOREIGN KEY (project_id)
        REFERENCES projects(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- =====================================
-- INSERTS: USERS
-- =====================================

INSERT INTO users (name, email, password, created_at, updated_at) VALUES
('Juan Pérez', 'juan@gmail.com', '$2y$12$ejemploHash1', NOW(), NOW()),
('María López', 'maria@gmail.com', '$2y$12$ejemploHash2', NOW(), NOW()),
('Carlos Ruiz', 'carlos@gmail.com', '$2y$12$ejemploHash3', NOW(), NOW()),
('Ana García', 'ana@gmail.com', '$2y$12$ejemploHash4', NOW(), NOW()),
('Pedro Sánchez', 'pedro@gmail.com', '$2y$12$ejemploHash5', NOW(), NOW());

-- =====================================
-- INSERTS: PROJECTS
-- =====================================

INSERT INTO projects (user_id, title, description, due_date, status, created_at, updated_at) VALUES
(1, 'Web corporativa', 'Desarrollo de una web para una empresa.', '2026-12-15', 'in_progress', NOW(), NOW()),
(1, 'Aplicación móvil', 'Aplicación móvil para gestionar tareas.', '2027-01-20', 'pending', NOW(), NOW()),
(2, 'Tienda online', 'Tienda online con carrito y pagos.', '2026-12-30', 'in_progress', NOW(), NOW()),
(3, 'Sistema de reservas', 'Sistema de reservas para restaurantes.', '2027-02-10', 'pending', NOW(), NOW()),
(4, 'Blog personal', 'Blog desarrollado con Laravel.', '2026-11-30', 'completed', NOW(), NOW()),
(5, 'Gestor de tareas', 'Aplicación para organizar tareas.', '2027-03-15', 'pending', NOW(), NOW());

-- =====================================
-- INSERTS: USER_PROJECT
-- =====================================

INSERT INTO user_project (user_id, project_id, role, contribution_hours) VALUES
(1, 1, 'admin', 25),
(2, 1, 'developer', 18),
(3, 1, 'designer', 12),
(1, 2, 'admin', 10),
(3, 2, 'developer', 15),
(2, 3, 'admin', 30),
(4, 3, 'developer', 20),
(5, 3, 'tester', 8),
(3, 4, 'admin', 12),
(4, 4, 'developer', 16),
(4, 5, 'admin', 40),
(5, 5, 'designer', 10),
(5, 6, 'admin', 5),
(1, 6, 'developer', 7);
