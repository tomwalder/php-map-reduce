# MapReduce for PHP 
Fan-out, Fan-in Processing, for PHP

## How It Works ##

You will need

1. A source of work to do (a `Workload`)
2. A way to break that work up into chunks (a `Sharder`)
3. Something to do on each chunk (a `Worker`)
4. A way to bring together the output of all your workers (an `Aggregator`)

And a JSON definition file to bring all of this together, which might look a bit like this

```json
{
    "name": "My first word count",
    "workload": {
        "TextFile": {
            "file": "page-of-text.txt"
        }
    },
    "sharder": {
        "FileSplitter": {
            "lines": 10
        }
    },
    "worker": "WordCounter",
    "agg": "Summer"
}
```



## Notes ##

Mostly stolen from Wikipedia, some thoughts my own.

> Processing and/or generating large data sets/or tasks in a parallel, distributed manner

> The "MapReduce System" (also called "infrastructure" or "framework") orchestrates the processing by marshalling the distributed servers, running the various tasks in parallel, managing all communications and data transfers between the various parts of the system, and providing for redundancy and fault tolerance.

> Optimizing the communication cost is essential to a good MapReduce algorithm.
