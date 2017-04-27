# learning-php

## Todo App

CRUD application to learn PHP basics.

### What I've learned in general:
- PHP syntax
- Doing stuff with $\_GET and $\_POST variables
- How to perform SQL queries with PDO
- Deploying application on Heroku from GitHub repository
- Setting up MySQL on Heroku and connecting to it

### What I've learned in detail:
- PHP assignment operator(=) is different from JavaScript. It sets the left operand to the value of the right and so not "equal to". To set the left equal to the right, use assignment by reference "$var = &$othervar;" syntax.
- PDO statement can only be looped once. Using a) syntax, foreach($items) for multiple times doesn't work. Instead, use b) syntax.
```
a) $items = $itemsQuery->rowCount() ? $itemsQuery : [];
b) $items = $itemsQuery->fetchAll(PDO::FETCH_ASSOC);
```
