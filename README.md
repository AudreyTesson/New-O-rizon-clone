# projet-great-place-to-webdev

## Installation

## Symfony
`symfony new my_project_directory --version=5.4 --webapp`
#### Webpack encore pour Symfony UX
`composer require symfony/webpack-encore-bundle`
[voir doc](https://symfony.com/doc/5.4/frontend/encore/installation.html)

#### formulaire et token csrf
`composer require form validator`

`composer require security-csrf`

#### sécurité
`composer require symfony/security-bundle`

### ***Si Symfony ne s'installe pas correctement*** :
#### création du projet symfony avec composer
`composer create-project symfony/skeleton:"^5.4" my_project_directory`
#### déplacement des fichiers à la racine
`mv ./my_project_directory/* ./my_project_directory/.* .`
#### suppression du dossier temporaire
`rmdir ./my_project_directory`
#### pour pouvoir utiliser @Route()
`composer require annotations`
#### TWIG
`composer require twig`
#### pour faire des liens correct dans twig vers nos assets
`composer require symfony/asset`
#### la barre de debug avec le backoffice de debug : profiler
`composer require --dev symfony/profiler-pack`
#### permet au dump de ne plus être dans la page, mais dans le WebDebugToolbar
`composer require --dev symfony/debug-bundle`
#### le maker
`composer require --dev symfony/maker-bundle`

## Faker/Fixtures
### création des fixtures
`composer require orm-fixtures --dev`
### faker général
`composer require fakerphp/faker`
### faker image
`composer require --dev bluemmb/faker-picsum-photos-provider ^2.0`

## installation de tous les composants pour Doctrine
### une question à laquelle on répond 'x'
`composer require symfony/orm-pack`

## Apache pack (réécriture d'URL et htaccess)
`composer require symfony/apache-pack`

## Tailwind CSS
[voir doc](https://www.google.com/url?q=https://www.yourigalescot.com/fr/blog/comment-integrer-tailwindcss-v3-a-un-projet-symfony-avec-webpack-encore&sa=D&source=docs&ust=1687283012661452&usg=AOvVaw39DxgFlU7WZJJStYheuH3S)

`yarn add --dev tailwindcss postcss autoprefixer`

`yarn tailwindcss init`

`yarn add postcss-loader --dev`

`yarn build`

#### pour lancer le server [voir doc](https://www.google.com/url?q=https://stackoverflow.com/questions/71608151/how-can-i-run-a-yarn-app-how-to-run-a-yarn-dev-server&sa=D&source=docs&ust=1687283250463153&usg=AOvVaw3EZ21Cn2zNPYa1B-D_-cVh)

#### Tailwind Form
`yarn add @tailwindcss/forms --dev`

### Tailwind components
#### tw element
`yarn add tw-elements`
#### Flowbite
`yarn add flowbite` [voir doc](https://flowbite.com/docs/getting-started/introduction/)
#### SASS
`yarn add sass-loader@^13.0.0 sass --dev`
#### Animated
`yarn add -D tailwindcss-animated` [voir doc](https://www.tailwindcss-animated.com/)

## Slider ranger control
`yarn add nouislider` [voir doc](https://refreshless.com/nouislider/)

## Pagination
`composer require knplabs/knp-paginator-bundle` [voir doc](https://github.com/KnpLabs/KnpPaginatorBundle)

## Mise à jour du composer.json avec les dépendances composer Back (symfony, doctrine …)
`composer install`
## Mise à jour du package.json avec les dépendances yarn Front (tailwind, SASS,)
`yarn install`
