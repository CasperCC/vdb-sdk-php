<?php

namespace Coccuscc\Vdb\common;

class Routes
{
    // DATABASE
    const DATABASE_CREATE_BASE = '/database/create';
    const DATABASE_CREATE_AI = '/ai/database/create';
    const DATABASE_DROP_BASE = '/database/drop';
    const DATABASE_DROP_AI = '/ai/database/drop';
    const DATABASE_LIST = '/database/list';

    // Collection
    const COLLECTION_LIST = '/collection/list';
    const COLLECTION_CREATE = '/collection/create';
    const COLLECTION_DROP = '/collection/drop';
    const COLLECTION_DESCRIBE = '/collection/describe';
    const COLLECTION_TRUNCATE = '/collection/truncate';

    // Document
    const DOCUMENT_UPSERT = '/document/upsert';
    const DOCUMENT_QUERY = '/document/query';
    const DOCUMENT_SEARCH = '/document/search';
    const DOCUMENT_HYBRID_SEARCH = '/document/hybridSearch';
    const DOCUMENT_DELETE = '/document/delete';
    const DOCUMENT_UPDATE = '/document/update';


}