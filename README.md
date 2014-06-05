php-txt2json
============

Converts idx TXT files to JSON files.

**Remember:** By definition, idx files are pre-sorted key-value pairs.
+ https://github.com/pffy/idx#idx

## BAD

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


## GOOD

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
