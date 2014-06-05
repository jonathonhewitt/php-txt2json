php-txt2json
============

Converts idx TXT files to JSON files.

![txt2json](https://raw.githubusercontent.com/pffy/php-txt2json/master/screenshot/screenshot-pffy-php-txt2json.png)

## GETTING STARTED

- Download `txt2json.php`.
- Run demo `php txt2json.php IdxHelloWorld.txt`
- Both input and results should be key-value pairs.
  + https://github.com/pffy/idx#idx (idx files are pre-sorted key-value pairs)


### BAD CONVERSION

Do not do this. The key `hello` is overwritten many times.

**TXT**
```
hello:world
hello:galaxy
hello:alphaquadrant
hello:gammaquadrant
hello:starfleet
```

**JSON**
```
{
    "hello": "starfleet"
}
```


### GOOD CONVERSION

Do this, instead. Keys are unique. Greetings are the same. ^^

**TXT**
```
world:hello
galaxy:hello
alphaquadrant:hello
gammaquadrant:hello
starfleet:hello
```

**JSON**
```
{
    "world": "hello",
    "galaxy": "hello",
    "alphaquadrant": "hello",
    "gammaquadrant": "hello",
    "starfleet": "hello"
}
```
