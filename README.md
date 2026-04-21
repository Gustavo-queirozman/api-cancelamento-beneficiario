# API de Cancelamento de Beneficiário

API desenvolvida para gerenciar o fluxo de cancelamento de beneficiários em uma cooperativa de saúde.

O projeto contempla autenticação de usuários, cadastro e gerenciamento de usuários, consulta prévia de beneficiário para solicitação de cancelamento, efetivação do cancelamento e configuração de e-mails em cópia para acompanhamento do processo.

---

## Visão geral

Esta API foi construída para centralizar e automatizar o processo de cancelamento de beneficiários, oferecendo uma camada de integração para:

- autenticação de usuários
- gerenciamento de usuários do sistema
- consulta de beneficiário antes do cancelamento
- registro de solicitações de cancelamento
- listagem de cancelamentos realizados
- configuração de destinatários para cópia de e-mails

---

## Tecnologias utilizadas

- PHP 8.1
- Laravel 10
- Laravel Passport
- Laravel Sanctum
- Guzzle
- PHPUnit
- Vite
- SQL Server (via driver PDO SQLSRV)

---

## Funcionalidades

### Autenticação
- login
- alteração/redefinição de credenciais

### Usuários
- registro de usuário
- listagem de usuários
- edição de usuário
- exclusão de usuário

### Cancelamento de beneficiário
- pesquisa de beneficiário por código de carteirinha
- solicitação de cancelamento
- efetivação do cancelamento
- listagem de cancelamentos

### Configuração de cópia de e-mail
- criação de destinatários
- listagem de destinatários
- edição de destinatários
- exclusão de destinatários

---

## Estrutura do projeto

```bash
app/
bootstrap/
config/
database/
lang/
public/
resources/
routes/
storage/
tests/
