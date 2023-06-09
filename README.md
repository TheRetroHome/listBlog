<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## listBlog

listBlog - это список дел, которые может заполнять пользователь. Встроена регистрация и авторизация. Реализован CRUD задач (с добавлением картинки 150x150) и частично тегов.
Теги каждый пользователь может создать свои (даже если они повторяются с тегами другого пользователя).
Пользователь не может видеть список дел других людей, а только свои. Реализована фильтрация по тегу, реализован
поиск какой то определённого дела. Пользователь может нажать на кнопку "Done" и его дело будет считаться выполненым, удалится 
из общего списка и будет перенесено в список "Выполненных задач".

## Установка и инструкция к использованию

1. Деплой кода начинается с его клонирование и настройка под ваш локальный веб сервер (будь то XAMPP или OpenServer), в случае с Open Server, стоит настроить домены и алиасы.
2. Перейти в папку с проектом с помощью консоли (прим. ```cd C:\ospanel\domains\listBlog```) и прописать миграции ```php artisan migrate```, согласиться на создание новой базы данных под названием listBlog
3. При переходе на главную страницу "/" вы обнаружите надпись _**"Чтобы воспользоваться функционалом, зарегестрируйтесь или авторизуйтесь"**_, в правом верхнем углу вы обнаружите кнопку "Register" 
4. При успешном вводе данных вы будете вновь переброшены на главную страничку, и отныне вам доступен функционал. Для создании задачи следует нажать на кнопку "Создать задачу", для создания тегов вам следует нажать на кнопку "Теги", при нажатии на кнопку "Выполненные задачи" вы ничего там не обнаружите, там будут появляться выполненные задачи.
5. При успешном создании тегов и задач (в задаче может быть несколько тегов), вы можете протестировать удаление, редактирование, выполнение задачи. Кнопка "Done" отправит задачу в "Выполненные задачи" и удалил из главного списка
6. При нажатии на тег, произойдёт фильтрация по нему (чтобы вернуться на главный экран нажмите на ListBlog в левом верхнем углу)
7. Работает также и поиск по задаче
8. Пагинация срабатывает от 5 задач
9. Картинка загруженная пользователем имеет разрешение 150x150 и попадает в отдельно-созданную папку с датой её загрузки.
10. Пользователь не видит задач других пользователей (и тегов соответственно), но может создавать точно такие же теги как и у других пользователей

### Функционал

- **Создание tasks (дел) или другими словами CRUD**
- **Создание уникальных тегов для пользователей (формируемые самим пользователем)**
- **Регистрация и авторизация и logout**
- **Возможность переносить задания в список выполненных**
- **Корректное добавление и отображение картинки 150x150**
- **Фильтрация списка по тегу**
- **Реализована пагинация с использованием bootstrap**
- **Реализован поиск по названию дела (только для невыполненных заданий)**
- **P.S Дополнительный функционал выполнен не был**

