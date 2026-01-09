-- Insertion des valeurs dans la table utilisateurs:
-- Admin
INSERT INTO utilisateurs (nom_user, email, role, mot_passe_hash) VALUES
('Admin Principal', 'admin@mabagnole.com', 'admin', md5('admin123'));

-- Clients
INSERT INTO utilisateurs (nom_user, cin, role, email, mot_passe_hash, telephone, ville, date_inscription) VALUES 
('Jean Dupont', 'AA1111', 'client', 'jean@example.com', md5('Jean123'), '0601020304', 'Casablanca', '2024-01-10 09:00:00'),
('Sami Mansour', 'BB2222', 'client', 'sami@example.com', md5('Sami123'), '0611223344', 'Rabat', '2024-01-12 10:30:00'),
('Lina Amor', 'CC3333', 'client', 'lina@example.com', md5('Lina123'), '0622334455', 'Marrakech', '2024-01-15 14:20:00'),
('Omar Hadid', 'DD4444', 'client', 'omar@example.com', md5('Omar123'), '0633445566', 'Agadir', '2024-02-01 11:15:00'),
('Yassine Ben', 'EE5555', 'client', 'yassine@example.com', md5('Yassine123'), '0644556677', 'Tanger', '2024-02-05 16:45:00'),
('Sara Fassi', 'FF6666', 'client', 'sara@example.com', md5('Sara123'), '0655667788', 'Fès', '2024-02-10 08:30:00'),
('Anas Sabiri', 'GG7777', 'client', 'anas@example.com', md5('Anas123'), '0666778899', 'Oujda', '2024-03-01 12:00:00'),
('Rita Kabbaj', 'HH8888', 'client', 'rita@example.com', md5('Rita123'), '0677889900', 'Meknès', '2024-03-05 17:10:00'),
('Karim Tazi', 'II9999', 'client', 'karim@example.com', md5('Karim123'), '0688990011', 'El Jadida', '2024-03-12 19:20:00'),
('Amal Laroui', 'JJ0000', 'client', 'amal@example.com', md5('Amal123'), '0699001122', 'Tétouan', '2024-03-20 10:00:00');