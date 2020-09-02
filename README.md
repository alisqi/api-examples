# Alis API example code
This repository contains examples in multiple languages for using the [Alis API](https://www.alisqi.com/en/product/alis-api).

These are meant to illustrate the ease of use, and to help you avoid common pitfalls.
Note that we do not provide support for this code, nor do we guarantee its correctness or security.

With this disclaimer out of the way, let's get started.

## Dummy values and placeholders
As described in the documentation, the URLs, sets and fields are specific to your particular installation.

Therefore, the code in this repository will use dummy values and placeholders.

## Operations
Each example performs the following steps
 * Store the results in this repo's [results.json](results-new.json) (using `storeResults`)
 * Get all "completed" results (field `status_` has option `Completed` selected) (using `getResults`)
 * Set `status_` to completed for (using `storeResults` again)

# Community examples
Some of our users have graciously shared some of their code and experience with us.

 * [Reading particle sensor measurements over Modbus](community/LamersHTS-Modbus) and uploading these to Alis
