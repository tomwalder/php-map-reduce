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
    "name": "tomwalder/wordcount",
    "description": "Example word count MapReduce",
    "workload": "TextFile",
    "sharder": {
        "FileSplitter": {
            "lines": 10
        }
    },
    "worker": "WordCounter",
    "agg": "Summer"
}
```
## API Endpoints ##

### /job/start ###

- called by remote client or web ui. supplied with any required instance configuration
- creates new job instance with unique [jiid]
- creates 1-n shard requests, each with unique [srid]
- queues 1-n async shard tasks one for each [srid] 

### /mapr/shard ###

- called async by the shard tasks created above
- passed the [srid]
- run concurrently with each other
- builds 1-n work packages (payloads) from the workload
    - creates a work request with uniue [wid]
    - queues an async work task for each [wid]

### /mapr/work ###

- does the work on a single payload

### /mapr/agg ###



## Notes ##

Mostly stolen from Wikipedia, some thoughts my own.

> Processing and/or generating large data sets/or tasks in a parallel, distributed manner

> The "MapReduce System" (also called "infrastructure" or "framework") orchestrates the processing by marshalling the distributed servers, running the various tasks in parallel, managing all communications and data transfers between the various parts of the system, and providing for redundancy and fault tolerance.

> Optimizing the communication cost is essential to a good MapReduce algorithm.
