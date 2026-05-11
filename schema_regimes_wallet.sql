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