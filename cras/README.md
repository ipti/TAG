## Staks de Desenvolvimento

- React
- Husky
- Lint Staged
- ESlint
- Prettier
- Commit Lint

## Commit Convencional

O commit segue o padr�o
[convetional commit](https://www.conventionalcommits.org/en/v1.0.0/#summary).

Estrutura do padr�o do commit:

```
<type>[optional scope]: <description>

[optional body]

[optional footer(s)]

```

Os tipos para commit s�o:

- build:, chore:, ci:, docs:, style:, refactor:, perf:, test:

A explica��o para o uso de cada tipo est� na documenta��o do link disponibilizado acima.

Exemplo de commit:

`git commit -m "chore: add files of configuration"`

### Vari�veis de ambiente

Crie uma c�pia do arquivo .env.example e e renomeie para .env

```bash
cp .env.example .env
```

Edite o arquivo criado no passo anterior e informe a URL da API

```bash
REACT_APP_API_URL=http://localhost/api
```

### Instalar depend�ncias

Para instalar as depend�ncias da aplica��o execute o comando abaixo:

```bash
yarn add "depend�ncia"
```

# Scripts dispon�veis

### Execu��o em modo de desenvolvimento

```bash
yarn start
```

### Executar linter do c�digo

```bash
yarn lint
```

### Criar build de produ��o

```bash
yarn build
```
