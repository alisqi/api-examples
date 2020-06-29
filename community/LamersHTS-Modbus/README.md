# Upload Modbus data to Alis
[Lamers High Tech Systems](https://aalberts-am.com/lamers/) has developed a prototype which reads data from
particle sensors over TCP/[Modbus](https://en.wikipedia.org/wiki/Modbus) and uploads the data to Alis.

The production context is measurement of high spec pressurized tubes.

Developer Paul Vermeulen generously shared the source code, along with the following comments (translated from Dutch):
> This code was called every 10 minutes (using crontab).
>
> Three particle sensors' buffers are read over TCP/Modbus (on IP address, port 502).
>
> A mapping is made from the device's values to the field names in the underlying analysis set of the Alis template.
> If a device was in the process of measuring, the resulting array of measurement values are posted to the Alis server.
>
> Each device's address was also added to a field so that the measurements of all devices appeared in the analysis set.
