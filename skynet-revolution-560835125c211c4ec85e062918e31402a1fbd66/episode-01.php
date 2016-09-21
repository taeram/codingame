<?php
fscanf(STDIN, "%d %d %d",
    $numNodes, // the total number of nodes in the level, including the gateways
    $numLinks, // the number of links
    $numExitGateways // the number of exit gateways
);

$nodes = null;
for ($i = 0; $i < $numLinks; $i++) {
    fscanf(STDIN, "%d %d",
        $N1, // N1 and N2 defines a link between these nodes
        $N2
    );

    if (!isset($nodes[$N1])) {
        $nodes[$N1] = null;
    }
    $nodes[$N1][] = $N2;

    if (!isset($nodes[$N2])) {
        $nodes[$N2] = null;
    }
    $nodes[$N2][] = $N1;
}

$exitNodes = null;
for ($i = 0; $i < $numExitGateways; $i++)
{
    fscanf(STDIN, "%d",
        $EI // the index of a gateway node
    );
    $exitNodes[] = $EI;
}

error_log(print_r(array(
    'num_nodes' => $numNodes,
    'num_links' => $numLinks,
    'num_exit_gateways' => $numExitGateways,
    'nodes' => $nodes,
    'exit_nodes' => $exitNodes
), 1));

$trimmedNodes = null;
while (TRUE)
{
    fscanf(STDIN, "%d",
        $skynetNode // The index of the node on which the Skynet agent is positioned this turn
    );

    // Are any of the connected nodes cxit nodes?
    $hasConnectedExitNode = false;
    for ($i = 0; $i < $numExitGateways; $i++) {
        if (in_array($exitNodes[$i], $nodes[$skynetNode])) {
            $nodeToDisconnect = $exitNodes[$i];
            $hasConnectedExitNode = true;
        }
    }
    if (!$hasConnectedExitNode) {
        // Remove a random node
        $nodeToDisconnect = $nodes[$skynetNode][0];
    }

    // Update the nodes list for the current Skynet Node
    $validNodes = null;
    for ($j = 0; $j < count($nodes[$skynetNode]); $j++) {
        if ($nodes[$skynetNode][$j] != $nodeToDisconnect) {
            $validNodes[] = $nodes[$skynetNode][$j];
        }
    }
    $nodes[$skynetNode] = $validNodes;

    // Update the nodes list for the current node to disconnect
    $validNodes = null;
    for ($j = 0; $j < count($nodes[$nodeToDisconnect]); $j++) {
        if ($skynetNode != $nodeToDisconnect) {
            $validNodes[] = $nodes[$nodeToDisconnect][$j];
        }
    }
    $nodes[$nodeToDisconnect] = $validNodes;

    // Example: 0 1 are the indices of the nodes you wish to sever the link between
    echo "$skynetNode $nodeToDisconnect\n";
}
