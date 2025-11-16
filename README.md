# 💰 MeuControleFinanceiro

Um sistema para ajudar você a controlar seus gastos e melhorar seu orçamento.

## 📋 Sobre o Projeto

Este sistema foi criado para ajudar pessoas que têm dificuldade em se organizar financeiramente, reunindo todas as contas em um só lugar. Com ele, você pode cadastrar suas despesas parceladas, acompanhar o que já pagou e ter uma visão clara do seu orçamento mensal.

## ✨ Funcionalidades

- 📊 Dashboard com valores totais, pendentes e pagos
- 💳 Cadastro de despesas parceladas (carro, eletrodomésticos, etc.)
- 📈 Barras de progresso mostrando quantas parcelas você já pagou
- 🧮 Cálculo automático dos valores (não precisa fazer conta!)
- 🔍 Filtro por categoria (mercado, luz, água, transporte, etc.)
- ✏️ Editar e excluir despesas quando precisar
- 🔐 Login seguro para proteger seus dados

## 🛠️ Tecnologias

- Laravel (framework PHP)
- MySQL (banco de dados)
- Tailwind CSS (visual)
- Laravel Breeze (sistema de login)

## 🚀 Como Instalar e Rodar

### Pré-requisitos

- PHP 8.1 ou superior
- Composer
- MySQL
- Node.js e NPM

### Passo a passo

1. **Clone o repositório**
```bash
git clone [url-do-seu-repositorio]
cd finance_organization
```

2. **Instale as dependências do PHP**
```bash
composer install
```

3. **Configure o arquivo de ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**

Abra o arquivo `.env` e configure suas credenciais do MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_organization
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. **Crie o banco de dados**

No MySQL, crie o banco:
```sql
CREATE DATABASE finance_organization;
```

6. **Rode as migrations e seeders**
```bash
php artisan migrate:fresh --seed
```

7. **Inicie o servidor**
```bash
php artisan serve
```

8. **Acesse o sistema**

Abra o navegador em: `http://localhost:8000`

### 👤 Credenciais de Teste

- **Email:** teste@teste.com
- **Senha:** 123456789

O sistema já vem com 7 despesas de exemplo para você testar todas as funcionalidades!