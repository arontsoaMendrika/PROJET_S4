USE regime;

-- 1. Table Portefeuille : Pour suivre le solde et le statut Gold
CREATE TABLE user_wallet (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0.00,
    is_gold BOOLEAN DEFAULT FALSE, -- Gère l'option Gold (remise 15%)
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_wallet_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 2. Table Codes de Recharge : Pour ta tâche "Gestion du portefeuille"
CREATE TABLE recharge_codes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    code_value VARCHAR(20) UNIQUE NOT NULL, -- Format ex: 'REG-1234-5678'
    amount DECIMAL(10,2) NOT NULL,
    is_used BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 3. Historique des transactions (Utile pour tes graphiques Admin)
CREATE TABLE transactions (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    wallet_id BIGINT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    type ENUM('credit', 'debit') NOT NULL,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_transaction_wallet FOREIGN KEY (wallet_id) REFERENCES user_wallet(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO recharge_codes (code_value, amount) VALUES
('REG001', 10.00),
('REG002', 20.00),
('REG003', 50.00),
('REG004', 100.00),
('REG005', 200.00),
('REG006', 500.00),
('REG007', 1000.00),
('REG008', 2000.00),
('REG009', 5000.00),
('REG010', 10000.00),
('REG011', 20000.00),
('REG012', 50000.00),
('REG013', 100000.00),
('REGG014', 200000.00),
('REGG015', 500000.00);
